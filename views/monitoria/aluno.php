
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\AlunoMonitoria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlunoMonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerenciar Monitorias';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <?php if (Yii::$app->user->identity->perfil == 'Aluno') { ?>
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li class="active"><a href="?r=monitoria/aluno">Lista</a></li>
        <?php } ?>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-aluno-index box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'summary' => '',
        //'showFooter'=>true,
        'showHeader' => true,
        'columns' => [
            'nomeDisciplina',
            'professor',
            [
                'attribute'=>'periodo',
                'filter' => ArrayHelper::map(AlunoMonitoria::find()->distinct()->orderBy(['periodo' => SORT_DESC])->asArray()->all(), 'periodo', 'periodo'),
            ],
            'codTurma',
            'nomeCurso',
            [
                'attribute'=> 'bolsa_traducao',
                'filter'=>array("Sim"=>"Sim","Não"=>"Não"),
            ],
            [
                'attribute'=> 'status',
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
                //'template' => '{view} {delete}',
                'template' => '{view}',
                'buttons' => 
                [
                    'view' => function ($url, $model) {
                        return Html::a(
                            //'<span class="glyphicon glyphicon-eye-open"></span>',
                            '<span class="label label-success"><i class=" fa fa-search"></i>&nbsp;</span>&nbsp;',
                            ['monitoria/view', 'id' => $model->id], 
                            [
                                'title' => 'Visualizar',
                                'aria-label' => 'Visualizar',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    //'delete' => function ($url, $model) {
                    //    return Html::a(
                    //        '<span class="glyphicon glyphicon-trash"></span>',
                    //        ['monitoria/delete', 'id' => $model->id], 
                    //        [
                    //            'title' => 'Delete',
                    //            'aria-label' => 'Delete',
                    //            'data-pjax' => '0',
                    //            'data-confirm' => 'Você realmente deseja deletar este item?',
                    //            'data-method' => 'post',
                    //        ]
                    //    );
                    //},
                ],
            ],
        ],
    ]); ?>

    <!--<a href="?r=monitoria/index" class="btn btn-default">Voltar</a>-->

    </div>
</div>
</section>
