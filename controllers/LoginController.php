<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Curso;
use app\models\CursoSearch;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\UsuarioForm;
use yii\helpers\Html;
use yii\helpers\Url;

use App\Anexo;

class LoginController extends Controller
{
    public $layout = 'login';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['GET'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('login');
    }

    public function actionLogin()
    {
        $route = "site/error";

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (Yii::$app->user->identity->isAdmin == 1) {
                $route = $this->redirect(["curso/index"]);
            }

            if (Yii::$app->user->identity->perfil == "Secretaria") {
                $route = $this->redirect(["solicitacao/index"]);
            }

            if (Yii::$app->user->identity->perfil == "Aluno") {
                $route = $this->redirect(["dashboard/index"]);
            }

            if (Yii::$app->user->identity->perfil == "Coordenador") {
                $route = $this->redirect(["dashboard/index"]);
            }

            return $route;

        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionAnexo()
    {
        return 'teste...';
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

      /* **** ***************************
    * Novo usuario via Webservice
    * ult.mod: 17/01/2016
    * *** ************************** */
    public function actionNovousuario()
    {

        if ( Yii::$app->request->post() ) 
        {
            
            $model = new Usuario();

            //verifica se o CPF já está cadastrado
            $usuario = Usuario::find()->where(['cpf' => Yii::$app->request->post('cpf') ])->one();

            if( $usuario != null )
            {

                return $this->render('novousuario', ['erro'=>'Usuário já cadastrado']);

            }

            //verifica se o EMAIL já está cadastrado
            $usuario = Usuario::find()->where(['email' => Yii::$app->request->post('email') ])->one();

            if( $usuario != null )
            {
                return $this->render('novousuario', ['erro'=>'EMAIL já cadastrado']);
            }

            /* * pega os dados do webservice do cpd * */
            $link = 'http://200.129.163.9:80801/ecampus_teste/servicos/getPessoaValidaSIE?cpf=' ;
            
            $link = $link . Yii::$app->request->post('cpf');

            $webservice = @file_get_contents($link);
            
            // Verifica se o WS está disponivel
            //Caso negativo ele exibe o formulario em branco
            if($webservice == null)
            {
                //return $this->render('novousuario', ['erro'=>'Não foi possível recuperar os dados do aluno']) ;
                $model->cpf = Yii::$app->request->post('cpf');
                $model->isNewRecord = true;
                //$model->save(false);
                return $this->render('create', ['model' => $model ]);
            }
            
            $dados = json_decode($webservice, true);

            //verifica se encontrou o CPF no ecampus
            if( isset( $dados['CPF inválido ']) )
            {
                return $this->render('novousuario', ['erro'=>'CPF não encontrado ou inválido']);
            }

            //Para alunos com mais de uma matricula
            //procura a matricula ativa
            //se nenhuma matrica estiver ativa.. o sistema volta a tela inicia
            $atual = null;
            
            foreach($dados as $aluno)
            {
                if($aluno["ATIVO"]=="true")
                {
                    $atual = $aluno;
                }
            }

            if($atual==null)
            {
                return $this->render('novousuario', ['erro'=>'O aluno não está ativo']);
            }
            
            // Adiciona os dados do aluno no model e redireciona p 
            // tela de cadastro...
            $model->name        = $atual['NOME_PESSOA'] ;
            
            $model->cpf         = Yii::$app->request->post('cpf');
            
            $model->email       = $atual['EMAIL'];
            
            $model->matricula   = $atual['MATR_ALUNO'];
            
            $curso_sigla = $atual['CURSO'];
            
            //Verifica se o curso pertence aos cursos
            //cadastrados
            $curso = Curso::find()->where(['codigo' => $curso_sigla])->one();
            
            if($curso==null)
            {
                throw new NotFoundHttpException('O Curso não está cadastrado para este aluno');
            }

            $model->curso_id = $curso->id;

            $model->isNewRecord = false;
            
            return $this->render('create', ['model' => $model ]);                 
        }
        // se a requisicao for do tipo GET
        else
        {
            return $this->render('novousuario') ;  
        }

    }
    
    public function actionRecuperarsenha()
    {

        
        if ( Yii::$app->request->post()) 
        {
            $email = Yii::$app->request->post('email');

            $usuario = Usuario::find()->where(['email'=>$email])->one();

            if($usuario!=null) //se o usuario com email informado existe...
            {
                
                //gera o token de troca senha
                $usuario->generatePasswordResetToken();
                $usuario->save(false);
                
                //prepara o email com o link
                $domain = 'sandbox081c87f9e07a4f669f46f26af7261c2a.mailgun.org';
                $key = 'key-f0dc85b59a45bcda5373019f605ce034';
                $mailgun = new \MailgunApi( $domain, $key );
                
                $message = $mailgun->newMessage();
                
                $message->setFrom('admin@icomp.ufam.edu.br', 'Admin-Atv Complementares');
                $message->addTo( $usuario->email, $usuario->name); //destinatario...
                $message->setSubject('Nova Senha');

                $url = Url::to(['login/resetpassword', 'token' => $usuario->password_reset_token] , true) ;
                
                $message->setHtml($this->renderPartial('email', ['usuario' => $usuario->name, 'url' => $url]), []);

                $message->send();

                return $this->render('senhaenviada');
            }
            else
            {
                return $this->render('emailnaoencontrado');
            }
        }
        else
        {   //se for metodo GET chama a view para informar o email
            return $this->render('recuperarsenha');
        }
    }
    
    /**
     * Reseta a senha do usuario informado.
     */
    public function actionResetpassword()
    {

        if ( Yii::$app->request->post() ) 
        {
            
            $model = new Usuario();
            
            //busca o usuario pelo ID
            $id = Yii::$app->request->post('id');
            
            $model = Usuario::find()->where(['id'=>$id])->one();
            
            $model->password = md5(Yii::$app->request->post('senhanova'));
            
            $model->save(false);

            return $this->goHome();
        }
        else
        {
            $model = new Usuario();
            
            //busca o usuario pelo token
            $token = Yii::$app->request->get('token');
            
            $model = Usuario::find()->where(['password_reset_token'=>$token])->one();

            if($model==null)
            {
                throw new NotFoundHttpException('A página procurada não existe.');
            }
            
            return $this->render('novasenha', ['model' => $model]);             
        }

    }

    public function actionTrocasenha()
    {
        if ( Yii::$app->request->post() )
        {

            $model = new Usuario();

            //busca o usuario pelo ID
            $id = Yii::$app->user->identity->id;

            $model = Usuario::find()->where(['id'=>$id])->one();

            $model->password = md5(Yii::$app->request->post('senhanova'));

            $model->save(false);

            return $this->redirect(['dashboard/index']);
        }
        else
        {
            $model = new Usuario();

            //busca o usuario pelo ID
            $id = Yii::$app->user->identity->id;

            $model = Usuario::find()->where(['id'=>$id])->one();

            if($model==null)
            {
                throw new NotFoundHttpException('A página procurada não existe.');
            }

            return $this->render('novasenha', ['model' => $model]);
        }
    }
    
}