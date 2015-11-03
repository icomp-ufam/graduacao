<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['usuario/create'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model, 'cpf')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php 
        if( $model->matricula != null ) 
        {
            echo $form->field($model, 'matricula')->textInput(['maxlength' => true]);

            echo $form->field($model, 'perfil')->textInput([
                'maxlength' => true, 
                'value'=>'Aluno',
                'disabled'=> 'disabled'
            ]);
        }
    ?>
    <?php 
        if( $model->siape != null ) 
        {
            echo $form->field($model, 'siape')->textInput(['maxlength' => true]);
        }
    ?>

    <?= $form->field($model, 'dtEntrada')->textInput() ?>


    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>