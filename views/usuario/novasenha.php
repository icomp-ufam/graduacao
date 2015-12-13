<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
    
    <h3>Usuario: <?= $model->name ?></h3>
    <h3>Informe a nova senha:</h3>
    <div class="form-group">
        
        <?= Html::input('text','senhanova') ?>
        <?= Html::input('hidden', 'token', $model->password_reset_token ) ?>
        <?= Html::input('hidden', 'id', $model->id ) ?>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>


<?php ActiveForm::end(); ?>