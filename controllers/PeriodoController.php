<?php

namespace app\controllers;

use Yii;
use app\models\Periodo;
use app\models\PeriodoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Command;

/**
 * PeriodoController implements the CRUD actions for Periodo model.
 */
class PeriodoController extends Controller
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
                                if ( Yii::$app->user->identity->perfil === 'Secretaria' ) 
                                {
                                    return Yii::$app->user->identity->perfil == 'Secretaria'; 
                                }
                                elseif ( Yii::$app->user->identity->perfil === 'Coordenador' ) 
                                {
                                    return Yii::$app->user->identity->perfil == 'Coordenador'; 
                                }
                                elseif ( Yii::$app->user->identity->perfil === 'admin' ) 
                                {
                                    return Yii::$app->user->identity->perfil == 'admin'; 
                                }
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
     * Lists all Periodo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeriodoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'erro' => ($this->getPeriodoAtivo() == null ? 1 : 0),
        ]);
    }

    /**
     * Displays a single Periodo model.
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
     * Creates a new Periodo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Periodo();

        if ($model->load(Yii::$app->request->post())) {

            // Quando marcado como o período corrente, então o demais não podem ser o corrente.
            if ($model->isAtivo == 1)
            {
                Yii::$app->db->createCommand()->update('periodo', ['isAtivo' => 0], 'id<>'.$model->id)->execute();
            }

            //$model->dtInicio = Yii::$app->formatter->asDate(strtotime($model->dtInicio), 'php:Y-m-d');
            //$model->dtTermino = Yii::$app->formatter->asDate(strtotime($model->dtTermino), 'php:Y-m-d');
            //$model->dtInicioInscMonitoria = Yii::$app->formatter->asDate(strtotime($model->dtInicioInscMonitoria), 'php:Y-m-d');
            //$model->dtTerminoInscMonitoria = Yii::$app->formatter->asDate(strtotime($model->dtTerminoInscMonitoria), 'php:Y-m-d');

            if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
			else
				return $this->render('create', ['model' => $model,]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Periodo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){ 

            // Quando marcado como o período corrente, então o demais não podem ser o corrente.
            if ($model->isAtivo == 1)
            {
                Yii::$app->db->createCommand()->update('periodo', ['isAtivo' => 0], 'id<>'.$id)->execute();
            }

            //$model->dtInicio = Yii::$app->formatter->asDate(strtotime($model->dtInicio), 'php:Y-m-d');
            //$model->dtTermino = Yii::$app->formatter->asDate(strtotime($model->dtTermino), 'php:Y-m-d');
            //$model->dtInicioInscMonitoria = Yii::$app->formatter->asDate(strtotime($model->dtInicioInscMonitoria), 'php:Y-m-d');
            //$model->dtTerminoInscMonitoria = Yii::$app->formatter->asDate(strtotime($model->dtTerminoInscMonitoria), 'php:Y-m-d');
			
            if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
			else
				return $this->render('update', ['model' => $model,]);
				
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Periodo model.
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
     * Finds the Periodo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Periodo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Periodo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getPeriodoAtivo()
    {
        return Periodo::findOne(['isAtivo' => 1]);
    }
}
