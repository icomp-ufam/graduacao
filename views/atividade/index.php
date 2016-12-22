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
            <?= Html::a('<i class="fa fa-plus-circle"></i> Nova Atividade', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                'codigo',
				'nome',
                'max_horas',
				//'curso',
				[   'label' => 'Grupo',
                'attribute' => 'grupo',
                'filter'=> array (1 => "Ensino",2 => "Pesquisa",3 => "Extensão"),
				'value' => 'grupo',
            ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
</section>
