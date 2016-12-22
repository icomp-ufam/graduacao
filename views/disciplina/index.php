<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisciplinaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disciplinas';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=disciplina/index"><i class="fa fa-calendar"></i> Disciplinas</a></li>
        <li class="active"><a href="?r=disciplina/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="disciplina-index box-body">

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Nova Disciplina', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
		'showOnEmpty' => false,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'codDisciplina',
            'nomeDisciplina',
            //'cargaHoraria',
            //'creditos',
            [
                'attribute'=> 'traducao_possui_monitoria',
                'label'=>'Disciplina com Monitoria',
                'filter'=>array("1"=>"Sim","0"=>"Não"),
            ],
            [   
                'class' => 'yii\grid\ActionColumn', 
                'header'=>'Ações', 
                'headerOptions' => ['style' => 'text-align:center; color:#337AB7'],
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle'],
            ],
        ],
    ]); ?>

    </div>
</div>
</section>
