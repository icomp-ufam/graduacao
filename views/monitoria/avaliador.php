<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\AlunoMonitoria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlunoMonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Julgar Inscrições em Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <?php if (Yii::$app->user->identity->perfil == 'Professor') { ?>
        <li><a href="?r=monitoria/avaliador"><i class="fa fa-check"></i> Julgar Inscrições em Monitoria</a></li>
        <li class="active"><a href="?r=monitoria/avaliador">Lista</a></li>
        <?php } ?>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-avaliador-index box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'summary' => '',
        //'showFooter'=>true,
        'showHeader' => true,
        'columns' => [
            [
                'attribute'=>'aluno',
                'label'=>'Nome Aluno'
            ],
            [
                'attribute'=>'codDisciplina',
                'label'=>'Cod. Disciplina'
            ],
            'nomeDisciplina',
            'professor',
            [
                'attribute'=>'periodo',
                'filter' => ArrayHelper::map(AlunoMonitoria::find()->distinct()->orderBy(['periodo' => SORT_DESC])->asArray()->all(), 'periodo', 'periodo'),
            ],
            [
                'attribute'=>'codTurma',
                'label'=>'Turma'
            ],
            'nomeCurso',
            [
                'attribute'=>'bolsa_traducao',
                'filter'=>array("Sim"=>"Sim","Não"=>"Não"),
            ],
            [
                'attribute'=>'status',
                'filter'=>array("Aguardando Avaliação"=>"Aguardando Avaliação",
                                "Selecionado com bolsa"=>"Selecionado com bolsa",
                                "Selecionado sem bolsa"=>"Selecionado sem bolsa",
                                "Não selecionado"=>"Não selecionado",
                                "Indeferido - Nota < 7"=>"Indeferido - Nota < 7",
                                "Indeferido - Coeficiente < 5"=>"Indeferido - Coeficiente < 5",
                                "Indeferido - Não cursou a disciplina"=>"Indeferido - Não cursou a disciplina"),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['style' => 'text-align:center; color:#337AB7'],
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle'],
                'template' => '{view}',
                'buttons' => 
                [
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="label label-success"><i class=" fa fa-search"></i>&nbsp;</span>&nbsp;',
                            ['monitoria/view', 'id' => $model->id], 
                            [
                                'title' => 'Detalhar',
                                'aria-label' => 'Detalhar',
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
