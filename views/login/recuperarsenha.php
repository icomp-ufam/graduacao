<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$this->title = 'Solicitar Nova Senha';
?>
<div class="col-md-4"></div>
<div class="col-xs-12 col-md-4">
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>
<section class="content">
<div class="box box-success">
	<div class=" box-body">
	<?php $form = ActiveForm::begin(); ?>

	     <div class="form-group">
            <label for="email" class="control-label" >Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Digite seu email de cadastro" />
         </div>

	    <div class="form-group">
	        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
	         <?= Html::a('Cancelar', ['login/login'], ['class' => 'btn btn-danger']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>
</div>
</section>
</div>
<div class="col-md-4"></div>