<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Frequencia;
use app\models\FrequenciaSearch;
use app\models\Usuario;
use app\models\Monitoria;
use app\models\AlunoMonitoria;
/**
 * FrequenciaController implements the CRUD actions for Frequencia model.
 */
class FrequenciaController extends Controller
{
    public function behaviors()
    {
        return [
            'acess' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update', 'delete', 'view', 'minhasfrequencias', 'modalimprimirfrequencias'],
                'rules' => [
                    [
                        'actions' => ['create','index','update', 'delete', 'view', 'minhasfrequencias', 'modalimprimirfrequencias'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (!Yii::$app->user->isGuest)
                            {
                                if ( Yii::$app->user->identity->perfil === 'Aluno' ) 
                                {
                                    return Yii::$app->user->identity->perfil == 'Aluno'; 
                                }
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Frequencia models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $frequencias = array();
        $registros = Frequencia::find()->where(['IDMonitoria' => $id])->all();
        
        foreach ($registros as $freq) 
        {
            $evento = new \yii2fullcalendar\models\Event();
            $evento->id = $freq->id;
            $evento->allDay = true;
            $evento->className = 'btn';
            
            if ( $freq->atividade == null ) 
                $evento->title = $freq->ch .'h';
            else 
                $evento->title = $freq->ch .'h ' . $freq->atividade;

            $evento->start = $freq->dmy;
            $frequencias[] = $evento;
        }

        return $this->render('index', [
            'events' => $frequencias,
            'erro' => ($registros != null ? 0 : 1),
            'idMonitoria' => $id,
        ]);  
    }

    /**
     * Displays a single Frequencia model.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionView($id)
    {
        $m = $this->findModel($id);
        $m->dataInicio = Yii::$app->formatter->asDate($m->dataInicio, 'php:d-m-Y');
        $m->dataFim = Yii::$app->formatter->asDate($m->dataFim, 'php:d-m-Y');
        return $this->render('view', [
            'model' => $m,
        ]);
    }   */

    /**
     * Creates a new Frequencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idmonitoria, $date)
    {
        $model = new Frequencia();
        $model->dmy = $date;
        $aluno = AlunoMonitoria::find()->where(['id' => $idmonitoria])->one();

        $pesquisa = Frequencia::find()->where(['IDMonitoria' => $aluno->id])->andWhere(['dmy' => $date])->one();
        
        if ($pesquisa == null)
        {
            if ($model->load(Yii::$app->request->post()) ) 
            {
                    $numDia = date('w', strtotime($date));
                    $qtdHorasRegistradas = 0;

                    $inicioSemana = strtotime('-'.$numDia.' day', strtotime($date));
                    $terminoSemana = strtotime('+'.(6 - $numDia).' day', strtotime($date));

                    $registros = Frequencia::find()
                        ->where(['IDMonitoria' => $aluno->id])
                        ->andWhere(['>=', 'dmy', date("Y-m-d",$inicioSemana)])
                        ->andWhere(['<=', 'dmy', date("Y-m-d",$terminoSemana)])
                        ->all();

                    // Carga horária semanal não pode ser superior a 12 horas
                    foreach ($registros as $reg) 
                    {
                        $qtdHorasRegistradas = $qtdHorasRegistradas + $reg->ch;
                    }

                    if ($model->ch + $qtdHorasRegistradas <= 12)
                    {
                        $model->IDMonitoria = $aluno->id;
                        $model->save();
                        return $this->redirect(['index', 'id' => $model->IDMonitoria,]);  
                    }
                    else return $this->redirect(['index', 'id' => $aluno->id, 'erro' => 3,]);
            }
            else return $this->renderAjax('create', [
                        'model' => $model,
                    ]);
        }
        else return $this->redirect(['index', 'id' => $aluno->id, 'erro' => 2,]);  
    }

    /**
     * Updates an existing Frequencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) ) 
        {
                $numDia = date('w', strtotime($model->dmy));
                $qtdHorasRegistradas = 0;

                $inicioSemana = strtotime('-'.$numDia.' day', strtotime($model->dmy));
                $terminoSemana = strtotime('+'.(6 - $numDia).' day', strtotime($model->dmy));

                $registros = Frequencia::find()
                    ->where(['IDMonitoria' => $model->IDMonitoria])
                    ->andWhere(['>=', 'dmy', date("Y-m-d",$inicioSemana)])
                    ->andWhere(['<=', 'dmy', date("Y-m-d",$terminoSemana)])
                    ->all();

                // Carga horária semanal não pode ser superior a 12 horas
                foreach ($registros as $reg) 
                {
                    // O registro que está sendo alterado não entra no somatório
                    if ($reg->id != $id)
                        $qtdHorasRegistradas = $qtdHorasRegistradas + $reg->ch;
                }

                if ($model->ch + $qtdHorasRegistradas <= 12)
                {
                    $model->save();
                    return $this->redirect(['minhasfrequencias', 'id' => $model->IDMonitoria]);
                }
                else return $this->redirect(['index', 'id' => $model->IDMonitoria, 'erro' => 3,]);
        } 
        else {
                return $this->render('update', [
                    'model' => $model,
                ]);
        }
    }

    /**
     * Deletes an existing Frequencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $idMonitoria = $model->IDMonitoria;
        $model->delete();

        return $this->redirect(['minhasfrequencias', 'id' => $idMonitoria]);
    }

    /**
     * Finds the Frequencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Frequencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Frequencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página requisitada não existe.');
        }
    }

    public function actionMinhasfrequencias($id)
    {
        $searchModel = new FrequenciaSearch();
        $dataProvider = $searchModel->searchMinhasFrequencias(Yii::$app->request->queryParams, $id);

        return $this->render('minhasfrequencias', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    public function actionModalimprimirfrequencias($idmonitoria)
    {
        if (Yii::$app->request->post('mes') && Yii::$app->request->post('ano')) {
            return $this->redirect(['/monitoria/frequenciaindividual', 'idmonitoria' => $idmonitoria, 'mes' => Yii::$app->request->post('mes'), 'ano' => Yii::$app->request->post('ano')]);
        } else {

            $cmd = Yii::$app->db->createCommand("SELECT distinct month(dmy) as id, monthname(dmy) as nome FROM frequencia WHERE IDMonitoria = :IDMonitoria ORDER BY month(dmy)", 
                ['IDMonitoria' => $idmonitoria]);
            //array com os meses das frequências cadastradas
            $meses = $cmd->queryAll();

            $cmd = Yii::$app->db->createCommand("SELECT distinct year(dmy)  as ano FROM frequencia WHERE IDMonitoria = :IDMonitoria ORDER BY year(dmy) DESC", 
                ['IDMonitoria' => $idmonitoria]);
            //array com os anos das frequências cadastradas
            $anos = $cmd->queryAll();

            //foreach ($meses as $mes)
            for ($i=0; $i < count($meses); $i++)
            {
                $meses[$i]['nome'] = $this->nomeMes($meses[$i]['id']);
            }

            $arrayMeses = ArrayHelper::map($meses, 'id', 'nome');
            $arrayAnos = ArrayHelper::map($anos, 'ano', 'ano');

            return $this->renderAjax('_form2', ['idmonitoria' => $idmonitoria, 'arrayMeses' => $arrayMeses, 'arrayAnos' => $arrayAnos]);
        }
    }

    public function nomeMes($mes) 
    {
        switch ($mes)
        {
            case 1: 
                $mes = 'Janeiro';
                break;
            case 2: 
                $mes = 'Fevereiro';
                break;
            case 3: 
                $mes = 'Março';
                break;
            case 4: 
                $mes = 'Abril';
                break;
            case 5: 
                $mes = 'Maio';
                break;
            case 6: 
                $mes = 'Junho';
                break;
            case 7: 
                $mes = 'Julho';
                break;
            case 8: 
                $mes = 'Agosto';
                break;
            case 9: 
                $mes = 'Setembro';
                break;
            case 10: 
                $mes = 'Outubro';
                break;
            case 11: 
                $mes = 'Novembro';
                break;
            case 12: 
                $mes = 'Dezembro';
                break;
        }
        return $mes;
    }
}
