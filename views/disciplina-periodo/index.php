<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\DisciplinaPeriodo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisciplinaPeriodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oferta Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=disciplina-periodo/index"><i class="fa fa-calendar"></i> Oferta Monitoria</a></li>
        <li class="active"><a href="?r=disciplina-periodo/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="disciplina-periodo-index box-body">

    <?php if(isset($erro) && $erro == 1) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Não existe período ativo no sistema. Ative ou cadastre o período corrente."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <p>
        <?= Html::a('Nova Oferta', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Importar Disciplinas - Arquivo CSV', ['importarcsv'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
		//'showOnEmpty' => false,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'idDisciplina',
            [
                'attribute'=>'codDisciplina', 
                'value'=>'disciplina.codDisciplina'
            ],
            [
                'attribute'=>'idDisciplina', 
                'value'=>'disciplina.nomeDisciplina'
            ],
            'codTurma',
            //'idCurso',
            [
                'attribute'=>'idCurso', 
                'value'=>'curso.nome'
            ],
            //'idProfessor',
            [
                'attribute'=>'idProfessor', 
                'value'=>'usuario.name'
            ],
            // 'nomeUnidade',
            // 'qtdVagas',
            [
                'attribute'=>'qtdMonitorBolsista', 
                'label'=>'Bolsista'
            ],
            [
                'attribute'=>'qtdMonitorNaoBolsista', 
                'label'=>'Não Bolsista'
            ],
            //'anoPeriodo',
            //'numPeriodo',
            [
                'attribute'=>'anoPeriodo',
                'filter' => ArrayHelper::map(DisciplinaPeriodo::find()->distinct()->orderBy(['anoPeriodo' => SORT_DESC])->asArray()->all(), 'anoPeriodo', 'anoPeriodo'),
            ],
            [
                'attribute'=>'numPeriodo',
                'filter' => ArrayHelper::map(DisciplinaPeriodo::find()->distinct()->orderBy(['numPeriodo' => SORT_DESC])->asArray()->all(), 'numPeriodo', 'numPeriodo'),
            ],
            // 'dataInicioPeriodo',
            // 'dataFimPeriodo',
            // 'usaLaboratorio',
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
