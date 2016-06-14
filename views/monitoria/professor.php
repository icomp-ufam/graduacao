<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\ProfessorMonitoria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfessorMonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerenciar Monitorias';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <?php if (Yii::$app->user->identity->perfil == 'Professor') { ?>
        <li><a href="?r=monitoria/professor"><i class="fa fa-clone"></i> Gerenciar Monitorias</a></li>
        <li class="active"><a href="?r=monitoria/professor">Lista</a></li>
        <?php } ?>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-professor-index box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'summary' => '',
        //'showFooter'=>true,
        'showHeader' => true,
        'columns' => [
            [
                'attribute'=>'codDisciplina',
                'label'=>'Cod. Disciplina'
            ],
            'nomeDisciplina',
            'aluno',
            'codTurma',
            'nomeCursoDisciplina',
            //'nomeCursoAluno',
            [
                'attribute'=>'periodo',
                'filter' => ArrayHelper::map(ProfessorMonitoria::find()->distinct()->orderBy(['periodo' => SORT_DESC])->asArray()->all(), 'periodo', 'periodo'),
            ],
            [
                'attribute'=> 'bolsa_traducao',
                'filter'=>array("Sim"=>"Sim","Não"=>"Não"),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['style' => 'text-align:center; color:#337AB7'],
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle'],
                'template' => '{plano} {relatorio}',
                'buttons' => 
                [
                    'plano' => function ($url, $model) {
                        return Html::a(
                            '<span class="btn btn-primary">Plano Disciplina</span>',
                            ['monitoria/gerarplanosemestraldisciplina', 'id' => $model->id], 
                            [
                                'title' => 'Plano Disciplina',
                                'aria-label' => 'Plano Disciplina',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'relatorio' => function ($url, $model) {
                        return Html::a(
                            '<span class="btn btn-primary">Relatório</span>',
                            ['monitoria/gerarrelatoriosemestral', 'id' => $model->id], 
                            [
                                'title' => 'Relatório Semestral',
                                'aria-label' => 'Relatório Semestral',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

    </div>
</div>
</section>
