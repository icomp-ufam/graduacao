<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Comissao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComissaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comissão Avaliadora de Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=comissao/index"><i class="fa fa-calendar"></i> Comissão Monitoria</a></li>
        <li class="active"><a href="?r=comissao/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="comissao-index box-body">

    <p>
        <?= Html::a('Novo Avaliador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="col-md-6">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => '',
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'idProfessor', 
                    'value'=>'usuario.name'
                ],
                [   
                    'class' => 'yii\grid\ActionColumn', 
                    'header'=>'Ações', 
                    'headerOptions' => ['style' => 'text-align:center; color:#337AB7'],
                    'contentOptions' => ['style' => 'text-align:center; vertical-align:middle'],
                    'template' => '{delete}',
                    'buttons' => 
                    [
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                ['comissao/delete', 'id' => $model->id], 
                                [
                                    'title' => 'Delete',
                                    'aria-label' => 'Delete',
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