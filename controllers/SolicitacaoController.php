<?php

namespace app\controllers;

use app\models\Curso;
use app\models\Usuario;
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
                        'actions' => ['index', 'view', 'update', 'delete'],
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
        $model = $this->findModel($id);
		
		$atividade = Atividade::findOne($model->atividade_id);
        if ($atividade != null)
            $model->atividade_id = $atividade->codigo."-".$atividade->nome;
		
		return $this->render('view', [
            'model' => $model,
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
		
       if ($model->load(Yii::$app->request->post())){ // && $model->save()) {

            //$model->dtInicio = Yii::$app->formatter->asDate($model->dtInicio, 'php:Y-m-d');
            //$model->dtTermino = Yii::$app->formatter->asDate($model->dtTermino, 'php:Y-m-d');

            if(Yii::$app->user->identity->perfil == 'Aluno'){
                $model->solicitante_id = Yii::$app->user->identity->id;

                // <>

                // $domain = 'sandbox081c87f9e07a4f669f46f26af7261c2a.mailgun.org';
                // $key = 'key-f0dc85b59a45bcda5373019f605ce034';
                // $mailgun = new \MailgunApi( $domain, $key );
                
                // $message = $mailgun->newMessage();
                
                // $message->setFrom('sistemas@icomp.ufam.edu.br', 'Admin-Atv Complementares');
                // $message->addTo( <>, $model->name); //destinatario...
                // $message->setSubject('Nova Solicitação criada');

                // //$url = Url::to(['login/resetpassword', 'token' => $model->password_reset_token] , true) ;
                
                // $message->$message->setText('O aluno '. <> .' Acabou de criar uma nova solicitação de atividade');

                // $message->send();
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
     * Updates an existing Solicitacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post())){ 
			if($model->horasLancadas < $model->horasComputadas)
				$model->horasComputadas = $model->horasLancadas;
				
			if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
			else
				return $this->render('update', ['model' => $model,]);
			
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

        return $this->redirect(['index', 'success' => 'Solicitação excluída com sucesso']);
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
      //  } else if ($_POST['action'] == 'Arquivar') {
            //$status = 'Arquivada';
        } else if ($_POST['action'] == 'Deferir') {
            $status = 'Deferida';
        }else if ($_POST['action'] == 'Indeferir'){
            $model->aprovador_id = Yii::$app->user->identity->id;
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
					$s->aprovador_id = Yii::$app->user->identity->id;
                }
				else{
					return $this->redirect(['index','error' => 'Apenas solicitações com status SUBMETIDA podem ser Avaliadas']);
				}
				
            }

            if(Yii::$app->user->identity->perfil=='Coordenador')
            {
                if($s->status=='Pre-Aprovada' || $s->status=='Submetida')
                {
                    $s->status = $status;
					$s->aprovador_id = Yii::$app->user->identity->id;
					$s->horasComputadas = $this->computarHoras($s);
  //                  $s->save();
                }
				//else if(($s->status=='Deferida' || $s->status=='Indeferida') && $status == 'Arquivada'){
                  //  $s->status = $status;
                    //$s->save();
				//}
				else{
					return $this->redirect(['index','error' => 'Apenas solicitações com status SUBMETIDAS ou PRÉ-APROVADAS podem ser Avaliadas']);
				}
            }

            $s->save(false);
        }
		//$this->mensagens('success', 'Sucesso', 'Solicitação pré-aprovada com sucesso.');
		//Yii::$app->session->setFlash('success', "Your message to display");
        return $this->redirect(['index','success' => 'Solicitação(ões) processada(s) com sucesso']);
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

/**
     * Lists Report with all Solicitacao.
     * @return mixed
     */
    
	
    /*public function actionRelatorio()
    {
        $cmd = Yii::$app->db->createCommand("SELECT usuario.id as id, usuario.name as nome,usuario.matricula as matricula, periodo.codigo as periodo,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Ensino'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
														AND usuario.isAtivo = 1
                                                        AND solicitacao.periodo_id = periodo.id
                                                    ) as ensino,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Pesquisa'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
														AND usuario.isAtivo = 1
                                                        AND solicitacao.periodo_id = periodo.id
                                                    ) as pesquisa,
                                                    (
                                                        SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                        FROM solicitacao 
                                                        JOIN atividade on solicitacao.atividade_id = atividade.id
                                                        JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Extensão'
                                                        WHERE solicitacao.status = 'Deferida'
                                                        AND usuario.id = solicitacao.solicitante_id
														AND usuario.isAtivo = 1
                                                        AND solicitacao.periodo_id = periodo.id

                                                    ) as extensao

                                             FROM usuario
                                             JOIN solicitacao on usuario.id = solicitacao.solicitante_id
                                             JOIN periodo on solicitacao.periodo_id = periodo.id
                                             WHERE usuario.curso_id = :curso AND usuario.isAtivo = 1
                                             AND usuario.perfil = 'Aluno'
                                             GROUP BY usuario.name, periodo.codigo",[':curso' => Yii::$app->user->identity->curso_id]);

        $dados = $cmd->queryAll();
       

        return $this->render('relatorio', ['resultado' => $dados]);

    }*/

	public function actionRelatorio()
    {   
        $action = Yii::$app->request->post('Periodo');
        if($action != null){
            $id = $action['id'];
            $model = Periodo::findOne($id);
        }else{
            $model = Periodo::find()->where("isAtivo = 1")->one();
        }

        $cmd = Yii::$app->db->createCommand("SELECT usuario.id as id, usuario.name as nome,usuario.matricula as matricula,
                                                  (
                                                      SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                      FROM solicitacao 
                                                      JOIN atividade on solicitacao.atividade_id = atividade.id
                                                      JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Ensino'
                                                      WHERE solicitacao.status = 'Deferida'
                                                      AND usuario.id = solicitacao.solicitante_id
                          AND usuario.isAtivo = 1
                                                      AND solicitacao.periodo_id = :periodo
                                                  ) as ensino,
                                                  (
                                                      SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                      FROM solicitacao 
                                                      JOIN atividade on solicitacao.atividade_id = atividade.id
                                                      JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Pesquisa'
                                                      WHERE solicitacao.status = 'Deferida'
                                                      AND usuario.id = solicitacao.solicitante_id
                          AND usuario.isAtivo = 1
                                                      AND solicitacao.periodo_id = :periodo
                                                  ) as pesquisa,
                                                  (
                                                      SELECT COALESCE(sum(solicitacao.horasComputadas), 0)
                                                      FROM solicitacao 
                                                      JOIN atividade on solicitacao.atividade_id = atividade.id
                                                      JOIN grupo on atividade.grupo_id = grupo.id AND grupo.nome = 'Extensão'
                                                      WHERE solicitacao.status = 'Deferida'
                                                      AND usuario.id = solicitacao.solicitante_id
                          AND usuario.isAtivo = 1
                                                      AND solicitacao.periodo_id = :periodo

                                                  ) as extensao

                                           FROM usuario JOIN solicitacao on
                                           usuario.id =
                                           solicitacao.solicitante_id JOIN
                                           periodo on solicitacao.periodo_id =
                                           :periodo WHERE usuario.curso_id =
                                           :curso AND usuario.isAtivo = 1 AND
                                           usuario.perfil = 'Aluno' AND
                                           solicitacao.status = 'Deferida' GROUP BY
                                           usuario.name",[':curso' => Yii::$app->user->identity->curso_id, ':periodo' => $model->id]);

      $dados = $cmd->queryAll();
        
      return $this->render('relatorio', ['resultado' => $dados, 'model' => $model]);

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
	
	        /* Computar quantas horas serão totalizadas ao aluno */
    protected function computarHoras($s){
        
		$horasAtual = $s->horasLancadas;
        
		// Verificando se ultrapassa o total da ATIVIDADE
		$Atividade = Atividade::findOne($s->atividade_id);

        if ($horasAtual > $Atividade->max_horas) {
            $horasAtual = $Atividade->max_horas;
        }
		
		// Verificando se ultrapassa o total do GRUPO
		
		//calcula a quantidade de horas que o Aluno ja tem naquela atividade...
        $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma
                    FROM solicitacao AS S
                    JOIN atividade AS A ON A.id = S.atividade_id
                    JOIN grupo AS G ON G.id = A.grupo_id
                    WHERE solicitante_id = $s->solicitante_id
					AND status = 'Deferida'
                    AND G.id IN (SELECT grupo_id FROM atividade WHERE id = $s->atividade_id)
                    GROUP BY (G.id)");

        $hsProduzidas = $cmd->queryScalar();		
				
		$Grupo = Grupo::findOne(['id' => $Atividade->grupo_id]);
        $MaxHorasGrupo = (int) $Grupo->max_horas;
		
		if(($hsProduzidas + $horasAtual) > $MaxHorasGrupo)
        {
            $horasAtual = $MaxHorasGrupo - ($hsProduzidas + $horasAtual);

        }
		
		// Verificando se ultrapassa o total do CURSO
	
		//calcula a quantidade de horas que o Aluno ja tem naquela atividade...
		$cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
				FROM solicitacao AS S
				WHERE solicitante_id = $s->solicitante_id
				AND status = 'Deferida'");

		$hsProduzidas = $cmd->queryScalar();		
	
		$curso_id = Yii::$app->user->identity->curso_id;
			
		$Curso = Curso::findOne(['id' => $curso_id]);
		$MaxHorasCurso = (int) $Curso->max_horas;
	
		if(($hsProduzidas + $horasAtual) > $MaxHorasCurso)
		{
			$horasAtual = $MaxHorasCurso - ($hsProduzidas + $horasAtual);
		}
		
		if($horasAtual < 0) $horasAtual = 0;
	
		return $horasAtual;
	}

}
