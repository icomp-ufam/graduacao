<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\UsuarioForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once('..\vendor\autoload.php'); //necessario p mailgun-php

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->password = md5($model->password);
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /* **** ***************************
    * denilson
    * *** ************************** */
    public function actionNovousuario()
    {

        if ( Yii::$app->request->post()) 
        {
            
            $model = new Usuario();
            
            /* * pega os dados do webservice do cpd * */
            $link = 'http://200.129.163.9:8080/ecampus/servicos/getPessoaValidaSIE?cpf=' ;
            
            $link = $link . Yii::$app->request->post('cpf');

            $webservice = file_get_contents($link);
            
            $dados = json_decode($webservice, true);

            $model->name = $dados[0]['NOME_PESSOA'] ;
            
            $model->cpf = Yii::$app->request->post('cpf');

            $model->email = $dados[0]['EMAIL'];
            
            $model->matricula = $dados[0]['MATR_ALUNO'];
            
            $model->perfil = Yii::$app->request->post('perfil');
            
            $model->isNewRecord = true;
            
            return $this->render('create', ['model' => $model]);  

        }
        else
        {
            return $this->render('novousuario');  
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
                $domain = 'sandbox081c87f9e07a4f669f46f26af7261c2a.mailgun.org';
                $key = 'key-f0dc85b59a45bcda5373019f605ce034';

                $mailgun = new \MailgunApi( $domain, $key );

                $message = $mailgun->newMessage();
                $message->setFrom('admin@icomp.ufam.edu.br', 'Admin-Atv Complementares');
                $message->addTo( $usuario->email, $usuario->name); //destinatario...
                $message->setSubject('Nova Senha');
                $message->setText('Sua nova senha temporária é: ' . $usuario->senhaAleatoria() );

                $message->send();
            }
            else
            {
                return 'email nao encontrado'; //melhorar isso para uma view...
            }
        }
        else
        {
            return $this->render('recuperarsenha');
        }
    }
}
