<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Atividade;
use app\models\Periodo;
use app\models\Usuario;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-6">
    <div class="solicitacao-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'us',
        'dateFormat' => 'dd-M-y',
    ]) ?>

    <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'us',
        'dateFormat' => 'dd-M-y',
    ]) ?>

    <!-- Atividades -->
    <?=
        $form->field($model, 'atividade_id')->dropDownList(ArrayHelper::map(\app\models\Atividade::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione']);
    ?>

    <?= $form->field($model, 'horasMaxAtiv')->textInput() ?>
    
    <?= $form->field($model, 'horasComputadas')->textInput() ?>
    
    <?= $form->field($model, 'atividade_id')->dropDownList(ArrayHelper::map(\app\models\Atividade::find()->all(), 
        'id', 'nome'), ['prompt'=>'Selecione'],
        [   'ajax' => [
            'type'=>'POST', //request type
            'url' => Url::to('solicitacao/gethorasmaximas'), //url to call.
            'update'=>'#horasMaxAtiv', //selector to update
            //'data'=>'js:javascript statement' 
        ]] ); ?>
 
    <?= $form->field($model, 'horasMaxAtiv')->textInput() ?>
    
    
    <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodo_id')->dropDownList(ArrayHelper::map(\app\models\Periodo::find()->all(), 'id', 'codigo'), ['prompt'=>'Selecione']);?>

    <?= $form->field($model, 'solicitante_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'aprovador_id')->hiddenInput(['value' => 0])->label(false) ?>
    
    <?= $form->field($model, 'status')->hiddenInput(['value' => 'Aberto'])->label(false) ?>
    
    <?= $form->field($model, 'anexo_id')->hiddenInput(['value' => 0])->label(false) ?>

    <br/>
    
   <?= $form->field($model, 'arquivo')->fileInput(['value'=>'arquivo']) ?>

    <br/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div> 
    
</div>

