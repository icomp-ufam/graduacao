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

<div class="col-md-4">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            //'enableAjaxValidation' => true,
            //'validationUrl' => 'validation-rul',
    ]); ?>

        <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
            'options' => ['class' => 'form-control'],
            'language' => 'pt-BR',
            'dateFormat' => 'dd-M-y',
        ]) ?>

        <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
            'options' => ['class' => 'form-control'],
            'language' => 'pt-BR',
            'dateFormat' => 'dd-M-y',
        ]) ?>

        <!-- Atividades -->

        <?php
            $atividades = \app\models\Atividade::find()->where(['curso_id'=>Yii::$app->user->identity->curso_id]);
        ?>

        <?= $form->field($model, 'atividade_id')
            ->dropDownList(ArrayHelper::map(\app\models\Atividade::find()->where(['curso_id'=>Yii::$app->user->identity->curso_id]), 'id', 'nome'), ['prompt'=>'Selecione',  'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('solicitacao/field').'&id=" + $(this).val(), function( data ) {
                  $( "input#maxHoras" ).val( data );
                });']); ?>
       
    
        <?= $form->field($model, 'horasComputadas')->textInput() ?>
        
        <div class="form-group">
            <label id="maxHoras" class="control-label" >Máx. Horas</label>
            <input type="text" class="form-control" disabled id="maxHoras" />
        </div>
        
        <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true]) ?>

        <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
             <?= $form->field($model, 'solicitante_id')->dropDownList(ArrayHelper::map(\app\models\Usuario::find()->where(['perfil' => 'Aluno'])
                ->orderBy('id ASC')->all(), 'id', 'name'), ['prompt'=>'Selecione']); ?>
        
        <?php } ?>
        
        
        <?= $form->field($model, 'status')->hiddenInput(['value' => 'Aberto'])->label(false) ?>
        
        <?= $form->field($model, 'anexo_id')->hiddenInput(['value' => 0])->label(false) ?>

        <?= $form->field($model, 'arquivo')->fileInput(['value'=>'arquivo']) ?>
       

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Cancelar', ['solicitacao/index'], ['class' => 'btn btn-danger']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>

