<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Frequencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frequencia-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'dmy')->textInput(['style'=>'width:100px', 'readonly' => true]) ?>

    <?= $form->field($model, 'ch')->textInput(['style'=>'width:100px'])->hint('Informar somente valores inteiros.') ?>

    <?= $form->field($model, 'atividade')->textInput(['style'=>'width:530px'])->label('Resumo das Atividades Realizadas') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
