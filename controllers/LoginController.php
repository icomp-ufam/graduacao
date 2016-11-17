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

            if (Yii::$app->user->identity->perfil == "Professor") {
                $route = $this->redirect(["monitoria/professor"]);
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
			$model->scenario = 'insert';

            //verifica se o CPF já está cadastrado
            $usuario = Usuario::find()->where(['cpf' => Yii::$app->request->post('cpf') ])->one();

            if( $usuario != null )
            {
                return $this->render('novousuario', ['erro'=>'Usuário já cadastrado']);
            }

            /* * pega os dados do webservice do cpd * */
            $cpf = Yii::$app->request->post('cpf');

            //$link = 'http://200.129.163.9:80801/ecampus_teste/servicos/getPessoaValidaSIE?cpf=' ;
			$token = "98df1b3e0103f57a9817d675071504ba-".date("Y-m-d");
			$tokenMD5 = MD5($token);
			$link = 'http://200.129.163.42:8080/ws/rest/sie/json/sieJSON/icomp?cpf='.$cpf.'&hshtkn='.$tokenMD5;

           // $link = $link . Yii::$app->request->post('cpf');

            $webservice = @file_get_contents($link);

            // Verifica se o WS está disponivel
            //Caso negativo ele exibe o formulario em branco
            if($webservice == null)
            {
                $model->cpf = Yii::$app->request->post('cpf');
                $model->isNewRecord = true;
				$model->isAtivo = 1;
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
                if($aluno["ativo"]=="true" && isset($aluno["matriculaAluno"]))
                {
                    $atual = $aluno;
                }
            }

            if($atual==null)
            {
                return $this->render('novousuario', ['erro'=>'O CPF não conrresponde a um aluno ativo na UFAM']);
            }
            
            // Adiciona os dados do aluno no model e redireciona p 
            // tela de cadastro...
            $model->name        = $atual['nome'] ;
            $model->cpf         = Yii::$app->request->post('cpf');
            $model->email       = $atual['email'];
            $model->matricula   = $atual['matriculaAluno'];
            $curso_sigla = $atual['curso'];
            
            //Verifica se o curso pertence aos cursos
            //cadastrados
            $curso = Curso::find()->where(['codigo' => $curso_sigla])->one();
			
            if($curso == null)
            {
               // throw new NotFoundHttpException('O Curso não está cadastrado para este aluno');
			   return $this->render('create', ['erro' => 'O curso associado ao aluno identificado não foi encontrado. Escolha o curso na lista acima.', 'model' => $model ]);                 
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

    public function actionCreate()
    {
        $model = new Usuario();
        
        if ($model->load(Yii::$app->request->post())){
            
            //verifica se o CPF já está cadastrado
            $usuario = Usuario::find()->where(['cpf' => $model->cpf ])->one();

            if( $usuario != null )
            {
                $model->addError('cpf','O CPF informado já está cadastrado...');
                return $this->render('create', ['model' => $model]);
            }

            //verifica se o EMAIL já está cadastrado
            $usuario = Usuario::find()->where(['email' => $model->email ])->one();

            if( $usuario != null )
            {
                $model->addError('email','O EMAIL informado já está cadastrado...');
                return $this->render('create', ['model' => $model]);
            }

            $model->password = md5($model->password);
	    $model->password_repeat = md5($model->password_repeat);
            
            if($model->save())
				return $this->redirect(['login']);
			else
				return $this->render('create', ['model' => $model,]);
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionRecuperarsenha()
    {

        
        if ( Yii::$app->request->post()) 
        {
            $email = Yii::$app->request->post('email');
	    
	    $model = new Usuario();
	    $model = Usuario::find()->where(['email'=>$email])->one();

            if($model != null) //se o usuario com email informado existe...
            {
                
                //gera o token de troca senha
                $model->generatePasswordResetToken();
                
				if($model->save(false)){
					
					//prepara o email com o link
					$domain = 'sandbox081c87f9e07a4f669f46f26af7261c2a.mailgun.org';
					$key = 'key-f0dc85b59a45bcda5373019f605ce034';
					$mailgun = new \MailgunApi( $domain, $key );
                
					$message = $mailgun->newMessage();
                
					$message->setFrom('sistemas@icomp.ufam.edu.br', 'Admin-Atv Complementares');
					$message->addTo( $model->email, $model->name); //destinatario...
					$message->setSubject('Nova Senha');

					$url = Url::to(['login/resetpassword', 'token' => $model->password_reset_token] , true) ;
                
					$message->setHtml($this->renderPartial('email', ['usuario' => $model->name, 'url' => $url]), []);

					$message->send();

					return $this->render('senhaenviada');
				}
				else{
					return $this->render('recuperarsenha');
				}
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
        if ( Yii::$app->request->post())
        {

            $model = new Usuario();

            //busca o usuario pelo ID
            $id = Yii::$app->user->identity->id;

            $model = Usuario::find()->where(['id'=>$id])->one();

            $model->password = md5(Yii::$app->request->post('senhanova'));

            if($model->save()){
			
				$this->mensagens('success', 'Alteração de Senha', 'A senha foi alterada com sucesso.');
			
				if(Yii::$app->user->identity->perfil == "admin")
					return $this->redirect(['login/trocasenha']);	
				else if(Yii::$app->user->identity->perfil == "Secretaria")
					return $this->redirect(['solicitacao/index']);	
				else
					return $this->redirect(['dashboard/index']);				
			}
			else
				return $this->render('novasenha', ['model' => $model]);
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
	
        /* Envio de mensagens para views
       Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }	
    
}
