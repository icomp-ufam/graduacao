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

                $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma, SUM(horasLancadas) AS somaLancadas, G.nome
                    FROM solicitacao AS S
                    JOIN atividade AS A ON A.id = S.atividade_id
                    JOIN grupo AS G ON G.id = A.grupo_id
                    WHERE solicitante_id = $id
					AND status = 'Deferida'
                    GROUP BY (G.id)
                ");
				
                //$hsEnsino = $cmd->queryScalar();
				$horasRetornadas = $cmd->queryAll();
				
				$horasComputadas = array();
				$horasComputadas["Ensino"] = $horasComputadas["Pesquisa"] = $horasComputadas["Extensão"] = 0;
				$horasLancadas = array();
				$horasLancadas["Ensino"] = $horasLancadas["Pesquisa"] = $horasLancadas["Extensão"] = 0;
				$horas["Ensino"] = $horas["Pesquisa"] = $horas["Extensão"] = 0;
				$totalConcluido = 0;
				
				foreach($horasRetornadas as $horaRetornada){
					//var_dump($hsEnsino[0]["soma"]);
					$horasComputadas[$horaRetornada["nome"]] = $horaRetornada["soma"];	
					$horasLancadas[$horaRetornada["nome"]] = $horaRetornada["somaLancadas"];	
					$totalConcluido += $horaRetornada["soma"];
				}
				
				$cmd = Yii::$app->db->createCommand("SELECT max_horas AS soma 
                    FROM curso AS C WHERE C.id IN (SELECT curso_id FROM usuario WHERE id = $id)
                ");
                
                $totalGrupos = $cmd->queryScalar();
                
                //POG-temporariamente
                //pega o valor total por grupo
                $grupos = [0=>0,
                    1=>Grupo::findOne(['nome' => 'Ensino'])->getAttribute('max_horas'),
                    2=>Grupo::findOne(['nome' => 'Pesquisa'])->getAttribute('max_horas'),
                    3=>Grupo::findOne(['nome' => 'Extensão'])->getAttribute('max_horas'),

                ];

                //$totalConcluido = $hsEnsino+$hsPesquisa+$hsExtensao;
                //$totalGrupos = $grupos[1] + $grupos[2] + $grupos[3];

                return $this->render('dashAluno', [
                    'horasEmEnsino'     =>  $horasComputadas["Ensino"], 
                    'horasEmPesquisa'   =>  $horasComputadas["Pesquisa"],
                    'horasEmExtensao'   =>  $horasComputadas["Extensão"],
                    'horasLancadasEmEnsino'     =>  $horasLancadas["Ensino"], 
                    'horasLancadasEmPesquisa'   =>  $horasLancadas["Pesquisa"],
                    'horasLancadasEmExtensao'   =>  $horasLancadas["Extensão"],
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