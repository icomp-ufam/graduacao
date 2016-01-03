<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\models\Solicitacao;

class DashboardController extends \yii\web\Controller
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
                                return Yii::$app->user->identity->perfil == 'Aluno' or Yii::$app->user->identity->perfil == 'Coordenador' ;
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

    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest)
        {

            /* *************************************************
            *  Dashboard de ALUNO
            *  ************************************************* */
            if(Yii::$app->user->identity->perfil == 'Aluno'){
                
                $id = Yii::$app->user->identity->id ;               

                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
                    FROM solicitacao AS S WHERE S.atividade_id 
                    IN (SELECT id FROM atividade WHERE grupo_id=1)
                    AND S.status='Submetida'
                    AND solicitante_id = $id 
                ");
                
                $hsEnsino = $cmd->queryScalar();

                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
                    FROM solicitacao AS S WHERE S.atividade_id 
                    IN (SELECT id FROM atividade WHERE grupo_id=2)
                    AND S.status='Submetida'
                    AND solicitante_id = $id 
                ");
                
                $hsPesquisa = $cmd->queryScalar();
                
                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
                    FROM solicitacao AS S WHERE S.atividade_id 
                    IN (SELECT id FROM atividade WHERE grupo_id=3)
                    AND S.status='Submetida'
                    AND solicitante_id = $id 
                ");
                
                $hsExtensao = $cmd->queryScalar();
                
                if($hsEnsino==null)     $hsEnsino   = 0 ;
                if($hsPesquisa==null)   $hsPesquisa = 0 ;
                if($hsExtensao==null)   $hsExtensao = 0 ;

                return $this->render('dashAluno', [
                    'horasEmEnsino'     =>  $hsEnsino, 
                    'horasEmPesquisa'   =>  $hsPesquisa,
                    'horasEmExtensao'   =>  $hsExtensao
                ]);
            }

            /* *************************************************
            *  Dashboard de COORDENADOR
            *  ************************************************* */
            if(Yii::$app->user->identity->perfil == 'Coordenador'){

                $curso = Yii::$app->user->identity->curso_id;

                $cmd = Yii::$app->db->createCommand("SELECT COUNT(*) AS contador 
                    FROM solicitacao AS S WHERE S.solicitante_id 
                    IN (SELECT id FROM usuario WHERE curso_id= $curso)
                    AND S.status='Submetida' 
                ");
                
                $enviadas = $cmd->queryScalar();
                
                if($enviadas==null)     $enviadas = 0 ;

                return $this->render('dashCoordenador', [
                    'enviadas' => $enviadas
                ]);
            
            }



            if(Yii::$app->user->identity->perfil == 'Secretaria'){
                return $this->render('dashSecretaria');
            }            
        }
        else
        {
            return false;
        }

    }
}