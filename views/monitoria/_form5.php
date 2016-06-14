<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

$this->title = 'Julgar Inscrição';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/avaliador"><i class="fa fa-check"></i> Julgar Inscrições em Monitoria</a></li>
        <li class="active"><a href="?r=monitoria/avaliador">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="monitoria-julgarinscricao-index box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Aluno',
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
            [
                'label' => 'Bolsista',
                'value' => $modelInfo->bolsa_traducao
            ],
        ],
        'options' => [
            'class' => 'table table-striped table-bordered detail-view',
            'style' => 'width:600px'
        ],
    ]) ?>

    <div class="monitoria-julgarinscricao-form">

        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>        

            <div style="width:380px;">
            <?= $form->field($model, 'status')->radioList(
                array(1=>'Selecionado com bolsa [Deferido]',
                2=>'Selecionado sem bolsa [Deferido]',
                3=>'Não selecionado [Indeferido]',
                4=>'Nota menor que 7.0 na disciplina [Indeferido]',
                5=>'Coeficiente menor que 5.0 [Indeferido]',
                6=>'Não cursou a disciplina ou equivalente [Indeferido]'))
                ->label('Selecione a Avaliação'); ?>
            </div>
            <div class="form-group">
                <?= Html::a('Cancelar', ['monitoria/avaliador'], ['class' => 'btn btn-danger']) ?>
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
</div>
</section>