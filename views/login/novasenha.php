<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/compara.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $form = ActiveForm::begin(); ?>
    
    <h3>Usuario: <?= $model->name ?></h3>
    <h3>Alteração de senha:</h3>
    <br/>
    <div class="form-group">

        Informe a senha: <?= Html::input('password','senhanova','', ['id'=>'pw1']) ?>
        <br/><br/>
        Repetir a senha: <?= Html::input('password','senhanova2','',['id'=>'pw2']) ?>

        <br/><br/>
        <?= Html::input('hidden', 'token', $model->password_reset_token ) ?>
        <?= Html::input('hidden', 'id', $model->id ) ?>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
         <?= Html::a('Cancelar', ['login/login'], ['class' => 'btn btn-danger']) ?>
    </div>

    <div class="col-md-6">
        <p class="alert alert-danger" id="status" hidden="true"></p>
    </div>

<?php ActiveForm::end(); ?>



