<?php

namespace app\controllers;

use app\models\Grupo;
use Yii;
use app\models\Solicitacao;
use app\models\SolicitacaoSearch;
use app\models\Atividade;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SolicitacaoController implements the CRUD actions for Solicitacao model.
 */
class SolicitacaoController extends Controller
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
                                return Yii::$app->user->identity->perfil == 'Coordenador' ;
                            }
                        }
                    ],[
                        'actions' => ['index', 'view', 'update'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->isGuest)
                            {
                                return Yii::$app->user->identity->perfil == 'Secretaria' ;
                            }
                        }
                    ],
                    [
                        'actions' => ['create', 'index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->isGuest)
                            {
                                return Yii::$app->user->identity->perfil == 'Aluno' ;
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
     * Lists all Solicitacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitacao model.
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
     * Creates a new Solicitacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Solicitacao();

        $model->created_at = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->dtInicio = Yii::$app->formatter->asDate($model->dtInicio, 'php:Y-m-d');
            $model->dtTermino = Yii::$app->formatter->asDate($model->dtTermino, 'php:Y-m-d');

            if(Yii::$app->user->identity->perfil == 'Aluno'){
                $model->solicitante_id = Yii::$app->user->identity->id;
            }

            $model->save();
            
            $file = UploadedFile::getInstance($model, 'arquivo');
            
            $file_name = Yii::$app->user->identity->id . '_' . rand(1, 999999);

            $file_name = $file_name . '.' . $file->extension;

            $model->arquivo = $file;

            $file->saveAs('uploads/' . $file_name);
            
            //atualiza os dados do nome no model solicitacao
            
            $model->anexoOriginalName = $file->baseName . '.' . $file->extension ;
            
            $model->anexoHashName = $file_name ;
            
            $model->arquivo = null ;     //estava dando erro na hora de salvar

            //verifica em qual periodo deve lançar a solicitacao
            //com base na data e nas datas de inicio e termino dos periodos cadastrados

            $cmd = Yii::$app->db->createCommand("SELECT id FROM periodo
                WHERE :fim
                BETWEEN date(dtInicio) AND date(dtTermino)",[':fim' => $model->dtTermino]);

            $model->periodo_id = (int) $cmd->queryScalar();

            $model->save();
            
            //redireciona para a view da solicitacao criada
            return $this->redirect(['index']);
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Solicitacao model.
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
     * Deletes an existing Solicitacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionField($id){
        $posts = Atividade::findOne($id);
        
        echo $posts->max_horas;
    }



     public function actionSubmit()
    {

        
        $selection = (array)Yii::$app->request->post('selection');//typecasting

        $action = Yii::$app->request->post('action');

        $status = '';


        if(!$selection){
            return $this->redirect(['index']);
        }

        if ($action == 'Submeter') {
            $status = 'Submetida';
        } else if ($_POST['action'] == 'Arquivar') {
            $status = 'Arquivada';
        } else if ($_POST['action'] == 'Deferir') {
            $status = 'Deferida';
        }else if ($_POST['action'] == 'Indeferir'){
            $status = 'Indeferida';
        }else{
            $status = 'Pre-Aprovada';
        }
        
        foreach($selection as $id){

            $s = Solicitacao::findOne((int)$id); //make a typecasting

            if(Yii::$app->user->identity->perfil=='Aluno')
            {
                if($s->status=='Aberto' || $s->status=='Indeferida')
                {
                    $s->status = $status;
                }
            }

            if(Yii::$app->user->identity->perfil=='Secretaria')
            {
                if($s->status=='Submetida')
                {
                    $s->status = $status;
                }
            }

            if(Yii::$app->user->identity->perfil=='Coordenador')
            {
                if($s->status=='Pre-Aprovada')
                {
                    $s->status = $status;
                    $s->save();
                }
                if($s->status=='Deferida')
                {
                    $s->status = $status;
                    $s->save();
                }
            }

            $s->save(false);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Solicitacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRelatorio()
    {
        $cmd = Yii::$app->db->createCommand("SELECT usuario.id, usuario.name, usuario.matricula
                    FROM usuario
                    WHERE usuario.curso_id = :curso
                    AND usuario.perfil = 'Aluno'
                ",[':curso' => Yii::$app->user->identity->curso_id]);

        //array com todos os alunos do curso do coord logado
        $alunos = $cmd->queryAll();

        // array com todos os grupos
        $grupos = Grupo::find()->all();

        // array com o resultado da consulta para a construcao da view
        $resultado = [];
        $resultadoCount = 0;

        foreach($alunos as $aluno)
        {
            //echo 'Nome: '. $aluno['name'] . ' Matrícula: ' . $aluno['matricula'] . '<br/>';
            $resultado[$resultadoCount]['nome']         = $aluno['name'];
            $resultado[$resultadoCount]['matricula']    = $aluno['matricula'];

            $grupoCount = 0;

            foreach($grupos as $grupo)
            {
                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma
                    FROM solicitacao AS S WHERE S.atividade_id
                    IN (SELECT id FROM atividade WHERE grupo_id = :grupoID)
                    AND S.status='Deferida'
                    AND S.solicitante_id = :alunoID
                ", ['grupoID' => $grupo->id, 'alunoID' => $aluno['id']
                ]);

                $soma = $cmd->queryScalar();

                if($soma==null) $soma=0;

                $resultado[$resultadoCount]['grupo'][$grupoCount]['descricao'] = $grupo->nome;
                $resultado[$resultadoCount]['grupo'][$grupoCount]['soma'] = $soma;

                $grupoCount++;

            }//Fim do ForEach Grupos

            $resultadoCount++;

        }//Fim do ForEach Alunos

        return $this->render('relatorio', ['resultado' => $resultado]);

    }

}
