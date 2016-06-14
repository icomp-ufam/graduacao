<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Frequências Registradas';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li><?= Html::a('&nbsp;&nbsp;Frequências', ['/frequencia/index', 'id' => $id], ['class' => 'fa fa-calendar']); ?></li>
        <li><?= Html::a('Lista', ['/frequencia/minhasfrequencias', 'id' => $id], ['class' => 'active']); ?></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="minhasfrequencias-index box-body">

    <div class="col-md-10">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => '',
        'showOnEmpty'=> false,
        'columns' => [
            [
                'attribute' => 'dmy',
                'format' => ['date', 'php:d-m-Y']
            ],
            'ch',
            'atividade',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['style' => 'text-align:center; color:#337AB7'],
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle'],
                'template' => '{update} {delete}',
                'buttons' => 
                [
                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="label label-primary"><i class=" fa fa-pencil"></i></span>&nbsp;',
                            ['frequencia/update', 'id' => $model->id], 
                            [
                                'title' => 'Alterar',
                                'aria-label' => 'Alterar',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="label label-danger"><i class=" fa fa-trash"></i></span>',
                            ['frequencia/delete', 'id' => $model->id], 
                            [
                                'title' => 'Deletar',
                                'aria-label' => 'Deletar',
                                'data-pjax' => '0',
                                'data-confirm' => 'Você realmente deseja deletar este item?',
                                'data-method' => 'post',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
    </div>
</div>
</section>
