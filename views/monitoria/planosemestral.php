<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$this->title = 'Plano Semestral de Monitoria do Período '.$model->codigo;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/secretaria"><i class="fa fa-clone"></i> Gerenciar Monitorias / Inscrições</a></li>
        <li class="active"><a href="?r=monitoria/secretaria">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="monitoria-planosemestral-index box-body">

    <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <?= Html::submitButton('Gerar PDF', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'justificativaPlanoSemestral')->textarea(['rows' => 6]) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <!--
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            'codDisciplina',
            'nomeDisciplina',
            'nomeCurso',
            'nomeProfessor',
            'qtdVagas',
            'lab_traducao',
            'qtdMonitorBolsista',
            'qtdMonitorNaoBolsista'
        ],
    ]); ?>
    -->
</div>
</div>
</section>