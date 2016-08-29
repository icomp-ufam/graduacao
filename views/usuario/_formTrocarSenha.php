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

    <?php 
	
	/*$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['usuario/create'],
    ]); */

	$form = ActiveForm::begin();
	?>
	
    <div class="col-md-5">
        
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'cpf')->textInput(['readonly' => true]) ?>
	
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>
  
	<?= $form->field($model, 'curso_id')->dropDownList(ArrayHelper::map(\app\models\Curso::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione']); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>
	<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true, 'value' => '']) ?>
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['/'], ['class' => 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
