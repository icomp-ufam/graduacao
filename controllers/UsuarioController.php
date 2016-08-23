<?php
namespace app\controllers;
use Yii;
use app\models\Usuario;
use app\models\Curso;
use app\models\UsuarioSearch;
use app\models\UsuarioForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
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
                'only' => ['create','index', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create','index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->isGuest)
                            {
                                return Yii::$app->user->identity->isAdmin == 1 ;
                            }
                        }
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

		$model = $this->findModel($id);
		
		$curso = Curso::findOne($model->curso_id);
        if ($curso != null)
            $model->curso_id = $curso->codigo."-".$curso->nome;
		
		return $this->render('view', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) ){//&& $model->save()) {

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

            // criptografa a senha...
            $model->password = md5($model->password);

            $model->save(false);

            return $this->redirect(['index']);

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

        if ($model->load(Yii::$app->request->post())){
			$model->save(false);
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
            throw new NotFoundHttpException('A página procurada não existe.');
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

            $model->save(false);
            
            return $this->redirect(['usuario/trocasenha','success' => 'Senha alterada com sucesso!']);
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