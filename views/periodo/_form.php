<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'pt-BR',
            'dateFormat' => 'dd-M-y',
            
        ]) ?>
    </div>
    

    <div class="form-group">    
        <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'pt-BR',
            'dateFormat' => 'dd-M-y',
        ]) ?>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
