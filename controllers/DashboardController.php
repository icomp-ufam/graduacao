<?php
namespace app\controllers;
use app\models\Grupo;
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
                    IN (SELECT atividade.id FROM atividade JOIN grupo ON grupo.id = atividade.grupo_id WHERE grupo.nome = 'Ensino')
                    AND S.status='Deferida'
                    AND solicitante_id =  $id 
                ");
                
                $hsEnsino = $cmd->queryScalar();

                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
                    FROM solicitacao AS S WHERE S.atividade_id 
                    IN (SELECT atividade.id FROM atividade JOIN grupo ON grupo.id = atividade.grupo_id WHERE grupo.nome = 'Pesquisa')
                    AND S.status='Deferida'
                    AND solicitante_id =  $id 
                ");
                
                $hsPesquisa = $cmd->queryScalar();
                
                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma 
                    FROM solicitacao AS S WHERE S.atividade_id 
                    IN (SELECT atividade.id FROM atividade JOIN grupo ON grupo.id = atividade.grupo_id WHERE grupo.nome = 'Extensão')
                    AND S.status='Deferida'
                    AND solicitante_id =  $id 
                ");
                
                $hsExtensao = $cmd->queryScalar();
				
				$cmd = Yii::$app->db->createCommand("SELECT max_horas AS soma 
                    FROM curso AS C WHERE C.id IN (SELECT curso_id FROM usuario WHERE id = $id)
                ");
                
                $totalGrupos = $cmd->queryScalar();
                
                if($hsEnsino==null)     $hsEnsino   = 0 ;
                if($hsPesquisa==null)   $hsPesquisa = 0 ;
                if($hsExtensao==null)   $hsExtensao = 0 ;

                //POG-temporariamente
                //pega o valor total por grupo
                $grupos = [0=>0,
                    1=>Grupo::findOne(['nome' => 'Ensino'])->getAttribute('max_horas'),
                    2=>Grupo::findOne(['nome' => 'Pesquisa'])->getAttribute('max_horas'),
                    3=>Grupo::findOne(['nome' => 'Extensão'])->getAttribute('max_horas'),

                ];

                $totalConcluido = $hsEnsino+$hsPesquisa+$hsExtensao;
                //$totalGrupos = $grupos[1] + $grupos[2] + $grupos[3];

                return $this->render('dashAluno', [
                    'horasEmEnsino'     =>  $hsEnsino, 
                    'horasEmPesquisa'   =>  $hsPesquisa,
                    'horasEmExtensao'   =>  $hsExtensao,
                    'maxHrsGrupos'      =>  $grupos,
                    'totalGrupos'       => $totalGrupos,
                    'totalConcluido'    =>  $totalConcluido
                ]);
            }

            /* *************************************************
            *  Dashboard de COORDENADOR
            *  ************************************************* */
            if(Yii::$app->user->identity->perfil == 'Coordenador'){

                $curso = Yii::$app->user->identity->curso_id;

                $query1 = Yii::$app->db->createCommand("SELECT COUNT(*) AS contador 
                    FROM solicitacao AS S WHERE S.solicitante_id 
                    IN (SELECT id FROM usuario WHERE curso_id= $curso)
                    AND S.status='Submetida' 
                ");
                
                $enviadas = $query1->queryScalar();
                
                $query2 = Yii::$app->db->createCommand("SELECT COUNT(*) AS contador 
                    FROM solicitacao AS S WHERE S.solicitante_id 
                    IN (SELECT id FROM usuario WHERE curso_id= $curso)
                    AND S.status='Pre-Aprovada' 
                ");

                $aberto = $query2->queryScalar();

                $query3 = Yii::$app->db->createCommand("SELECT COUNT(*) AS contador 
                    FROM solicitacao AS S WHERE S.solicitante_id 
                    IN (SELECT id FROM usuario WHERE curso_id= $curso)
                    AND S.status='Arquivada' 
                ");

                $arquivadas = $query3->queryScalar();

                if($enviadas==null)  $enviadas = 0 ;
                if($aberto==null)  $aberto = 0 ;
                if($arquivadas==null)  $arquivadas = 0 ;

                return $this->render('dashCoordenador', [
                    'enviadas' => $enviadas,
                    'aberto' => $aberto,
                    'arquivadas' => $arquivadas
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