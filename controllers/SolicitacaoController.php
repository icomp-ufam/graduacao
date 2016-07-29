<?php

namespace app\controllers;

use app\models\Grupo;
use app\models\Periodo;
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
		
		$periodo = Periodo::findOne(['isAtivo' => 1]); //Periodo::getPeriodoAtivo();
		$model->periodo_id = $periodo->id;
		

       if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->dtInicio = Yii::$app->formatter->asDate($model->dtInicio, 'php:Y-m-d');
            $model->dtTermino = Yii::$app->formatter->asDate($model->dtTermino, 'php:Y-m-d');

            if(Yii::$app->user->identity->perfil == 'Aluno'){
                $model->solicitante_id = Yii::$app->user->identity->id;
            }

            $file = UploadedFile::getInstance($model, 'arquivo');

            if(isset($file)){
                
                
                $file_name = Yii::$app->user->identity->id . '_' . rand(1, 999999);

                $file_name = $file_name . '.' . $file->extension;     

                $file->saveAs('uploads/' . $file_name);
                
                $model->arquivo = $file;
                
                //atualiza os dados do nome no model solicitacao
                
                $model->anexoOriginalName = $file->baseName . '.' . $file->extension ;
                
                $model->anexoHashName = $file_name ;
                
                $model->arquivo = null ;     //estava dando erro na hora de salvar  
            }

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
            $model->dtInicio = Yii::$app->formatter->asDate($model->dtInicio, 'php:Y-m-d');
            $model->dtTermino = Yii::$app->formatter->asDate($model->dtTermino, 'php:Y-m-d');
            $model->save();
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
           
            return $this->redirect(['index','error' => 'Selecione uma solicitação']);
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
				else{
					return $this->redirect(['index','error' => 'Apenas solicitações com status ABERTA ou INDEFERIDA podem ser submetidas']);
				}
            }

            if(Yii::$app->user->identity->perfil=='Secretaria')
            {
                if($s->status=='Submetida')
                {
                    $s->status = $status;
                }
				else{
					return $this->redirect(['index','error' => 'Apenas solicitações com status SUBMETIDA podem ser Avaliadas']);
				}
				
            }

            if(Yii::$app->user->identity->perfil=='Coordenador')
            {
                if($s->status=='Pre-Aprovada')
                {
                    $s->status = $status;
                    $s->save();
                }
                else if($s->status=='Deferida')
                {
                    $s->status = $status;
                    $s->save();
                }
				else{
					return $this->redirect(['index','error' => 'Apenas solicitações com status PRÉ-APROVADAS ou DEFERIDAS podem ser Avaliadas']);
				}
            }

            $s->save(false);
        }
		//$this->mensagens('success', 'Sucesso', 'Solicitação pré-aprovada com sucesso.');
		//Yii::$app->session->setFlash('success', "Your message to display");
        return $this->redirect(['index','success' => 'Solicitação(ões) encaminhadas com sucesso']);
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
        $cmd = Yii::$app->db->createCommand("SELECT usuario.id as id, usuario.name as nome,usuario.matricula as matricula, periodo.codigo as periodo,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Ensino'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
                                                        AND solicitacao.periodo_id = periodo.id
                                                    ) as ensino,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Pesquisa'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
                                                        AND solicitacao.periodo_id = periodo.id
                                                    ) as pesquisa,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Extensão'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
                                                        AND solicitacao.periodo_id = periodo.id

                                                    ) as extensao

                                             FROM usuario
                                             JOIN solicitacao on usuario.id = solicitacao.solicitante_id
                                             JOIN periodo on solicitacao.periodo_id = periodo.id
                                             WHERE usuario.curso_id = :curso
                                             AND usuario.perfil = 'Aluno'
                                             GROUP BY usuario.name, periodo.codigo",[':curso' => Yii::$app->user->identity->curso_id]);

        $dados = $cmd->queryAll();
       

        return $this->render('relatorio', ['resultado' => $dados]);

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
