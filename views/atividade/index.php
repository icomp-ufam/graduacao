<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtividadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atividades';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=atividade/index"><i class="fa fa-tasks"></i> Atividades</a></li>
        <li class="active"><a href="?r=atividade/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="atividade-index box-body">

        <p>
            <?= Html::a('Nova Atividade', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'columns' => [
                'nome',
                'max_horas',
				'curso',
                'grupo',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
</section>
