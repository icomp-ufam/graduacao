<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Curso;
use app\models\CursoSearch;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Novousuario;
use app\models\UsuarioForm;
use yii\helpers\Html;

use App\Anexo;

class SiteController extends Controller
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
        return $this->render('index');
        //return $this->redirect(["dashboard/index"]);
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
    
}