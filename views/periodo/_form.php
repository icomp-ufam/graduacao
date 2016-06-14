<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodo-form">

    <?php $form = ActiveForm::begin(); ?>
     <div class="col-md-4">
   
        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'language' => 'pt-BR',
                'dateFormat' => 'dd-MM-y',
        ]) ?>
        <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'language' => 'pt-BR',
                'dateFormat' => 'dd-MM-y',
        ]) ?>
        <?= $form->field($model, 'dtInicioInscMonitoria')->widget(\yii\jui\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'language' => 'pt-BR',
                'dateFormat' => 'dd-MM-y',
        ]) ?>
        <?= $form->field($model, 'dtTerminoInscMonitoria')->widget(\yii\jui\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'language' => 'pt-BR',
                'dateFormat' => 'dd-MM-y',
        ]) ?>

        <?= $form->field($model, 'isAtivo')->checkbox() ?>

        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['periodo/index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
        $('#periodo-dtinicio').on('change', function () {
        var test = $(this).datepicker('getDate');
        var testm = new Date(test.getTime());
        testm.setDate(testm.getDate() + 1);

        $("#periodo-dttermino").datepicker("option", "minDate", testm);
    });
</script>

<script>
        $('#periodo-dtinicioinscmonitoria').on('change', function () {
        var dtini2 = $(this).datepicker('getDate');
        var dtini2m = new Date(dtini2.getTime());
        dtini2m.setDate(dtini2m.getDate());

        $("#periodo-dtterminoinscmonitoria").datepicker("option", "minDate", dtini2m);
    });
</script>