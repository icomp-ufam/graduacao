<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DisciplinaPeriodo */

$this->title = $model->disciplina->nomeDisciplina . ' - Turma ' . $model->codTurma;
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
    <div class="disciplina-periodo-view box-body">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você realmente deseja deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'idDisciplina',
            'disciplina.codDisciplina',
            'disciplina.nomeDisciplina',
            //[
            //    'attribute'=>'idDisciplina',
            //    'value'=>$model->disciplina->nomeDisciplina,
            //    'type'=>DetailView::INPUT_SELECT2, 
            //    'widgetOptions'=>[
            //        'data'=>ArrayHelper::map(Disciplina::find()->orderBy('nomeDisciplina')->asArray()->all(), 'id', 'nomeDisciplina'),
            //    ]
            //],
            'codTurma',
            //'idCurso',
            'curso.nome',
            //'idProfessor',
            'usuario.name',
            'nomeUnidade',
            'numPeriodo',
            'anoPeriodo',
            [
                'label' => 'Data Início Período',
                'value' => date("d/m/Y",  strtotime($model->dataInicioPeriodo)),
            ],
            [
                'label' => 'Data Início Período',
                'value' => date("d/m/Y",  strtotime($model->dataFimPeriodo)),
            ],
            //'dataFimPeriodo:datetime',
            //'usaLaboratorio',
            [
                'label' => 'Usa Laboratório',
                'value' => $model->traducao_usa_laboratorio
            ],
            'qtdVagas',
            'qtdMonitorBolsista',
            'qtdMonitorNaoBolsista',
        ],
    ]) ?>

    </div>
</div>
</section>
