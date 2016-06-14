<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Periodo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Períodos';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=periodo/index"><i class="fa fa-calendar"></i> Período</a></li>
        <li class="active"><a href="?r=periodo/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
<div class="periodo-index box-body">

    <?php if(isset($erro) && $erro == 1) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Não existe período ativo no sistema. Ative ou cadastre o período corrente."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <p>
        <?= Html::a('Novo Período', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            'codigo',
            [
            'attribute' => 'dtInicio',
            'format' => ['date', 'php:d-m-Y']
            ],
            [
            'attribute' => 'dtTermino',
            'format' => ['date', 'php:d-m-Y']
            ],
            [
            'attribute' => 'dtInicioInscMonitoria',
            'format' => ['date', 'php:d-m-Y']
            ],
            [
            'attribute' => 'dtTerminoInscMonitoria',
            'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'isAtivo',
                'label'=>'Período Corrente', 
                'format' => 'raw',
                'value' => function ($model) {
                        if ($model->isAtivo == 1)
                            return '<div style="text-align:center"> <span class="glyphicon glyphicon-ok"></span> </div>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</section>