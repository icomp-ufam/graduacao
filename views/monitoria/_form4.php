<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

$this->title = 'Relatório Semestral de Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/professor"><i class="fa fa-clone"></i> Gerenciar Monitorias</a></li>
        <li class="active"><a href="?r=monitoria/professor">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="monitoria-relatoriosemestral-view box-body">

    <div class="monitoria-relatoriosemestral-recuperar">
        <p>
        <a href="https://www.dropbox.com/sh/1sx0q8g0c3rnmzj/AAB0GhB4RUdhuRqSdCYWdjdCa/7.%20Relat%C3%B3rio%20Final.doc?dl=0" target="_blank" class="btn btn-primary">Baixar Modelo do Relatório</a>

        <?php if (!empty($modelInfo->pathArqRelatorioSemestral)) { ?>
            <?= Html::a('Recuperar Arquivo', Url::base().'/'.$modelInfo->pathArqRelatorioSemestral, 
                [
                    'target'=>'_blank', 
                    'class'=>'btn btn-primary', 
                ]) ?>
        <?php } else { ?>
            <?= Html::a('Recuperar Arquivo', '', ['class'=>'btn btn-primary', 'disabled' => true]) ?>
        <?php } ?>
        
        </p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Monitor',
                'value' => $modelInfo->aluno
            ],
            [
                'label' => 'Disciplina',
                'value' => $modelInfo->nomeDisciplina
            ],
            [
                'label' => 'Período',
                'value' => $modelInfo->periodo
            ],
        ],
        'options' => [
            'class' => 'table table-striped table-bordered detail-view',
            'style' => 'width:600px'
        ],
    ]) ?>

    <div class="monitoria-relatoriosemestral-form">

        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?php if ($model->errors) { ?>
                <?= $form->errorSummary($model); ?>
            <?php } ?>
            
            <?= $form->field($model, 'fileRelatorioSemestral')->fileInput() ?>

            <div class="form-group">
                <?= Html::a('Cancelar', ['monitoria/professor'], ['class' => 'btn btn-danger']) ?>
                <?= Html::submitButton('Salvar Arquivo', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
</div>
</section>