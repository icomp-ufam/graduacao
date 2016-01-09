<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<section class="content">
<?php $form = ActiveForm::begin(); ?>

    <h2>Informe seu Email</h2>
    <div class="form-group">
        <?= Html::input('text','email') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
         <?= Html::a('Cancelar', ['login/login'], ['class' => 'btn btn-danger']) ?>
    </div>

<?php ActiveForm::end(); ?>
</section>