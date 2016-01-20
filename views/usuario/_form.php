<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Curso;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['usuario/create'],
    ]); ?>
    
    <div class="col-md-5">
        
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>
  
    <?= $form->field($model, 'curso_id')
                    ->dropDownList(ArrayHelper::map(\app\models\Curso::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione']); ?>

    <?php 
        if( $model->siape != null ) 
        {
            echo $form->field($model, 'siape')->textInput(['maxlength' => true]);
        }
    ?>
   
    <?php
    
    if(isset(Yii::$app->user->identity))
    {
        
        if(Yii::$app->user->identity->isAdmin)
        {
            
            $items = ['Secretaria'=>'Secretaria', 'Coordenador'=>'Coordenador', 'admin'=>'Admin', 'Aluno'=>'Aluno'];
            
            echo $form->field($model, 'perfil')->dropDownList($items, ['prompt'=>'Selecione']);
            
        }
        
    }
    //se não estiver logado o perfil do usuario será Aluno
    else
    {
        echo $form->field($model, 'perfil')->hiddenInput(['value' => 'Aluno'])->label(false);
    }

    ?>    
    <?php 
        if( $model->isNewRecord ) 
        {
    ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php 
        }
    ?>
   
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['usuario/index'], ['class' => 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
