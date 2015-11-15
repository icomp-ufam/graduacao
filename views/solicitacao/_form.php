<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtInicio')->textInput() ?>

    <?= $form->field($model, 'dtTermino')->textInput() ?>

    <?= $form->field($model, 'horasComputadas')->textInput() ?>

    <?= $form->field($model, 'horasMaxAtiv')->textInput() ?>

    <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'atividade_id')->textInput() ?-->

    <!--?= $form->field($model, 'periodo_id')->textInput() ?-->

    <!--?= $form->field($model, 'solicitante_id')->textInput() ?-->

    <!--?= $form->field($model, 'aprovador_id')->textInput() ?-->

    <!--?= $form->field($model, 'anexo_id')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
