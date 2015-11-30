<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Atividade;
use app\models\Periodo;
use app\models\Usuario;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'pt-BR',
        'dateFormat' => 'dd-M-y',
    ]) ?>

    <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'pt-BR',
        'dateFormat' => 'dd-M-y',
    ]) ?>

    <?= $form->field($model, 'horasComputadas')->textInput() ?>

    <?= $form->field($model, 'horasMaxAtiv')->textInput() ?>

    <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>-->

    <?php

    if(isset(Yii::$app->user->identity))
    {
        //$form = ActiveForm::begin();

        if(Yii::$app->user->identity->perfil == 'Coordenador')
        {

            $items = ['Em Edição'=>'Em Edição', 'Submetida'=>'Submetida', 'Pré-Aprovada'=>'Pré-Aprovada', 'Deferida'=>'Deferida', 'Indeferida'=>'Indeferida'];

        echo $form->field($model, 'status')->dropDownList($items, ['prompt'=>'Selecione']);

        }

        //ActiveForm::end();
    }

    ?>

    <?php
    echo $form->field($model, 'atividade_id')->dropDownList(ArrayHelper::map(\app\models\Atividade::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione']);
    ?>

    <?php
    echo $form->field($model, 'periodo_id')->dropDownList(ArrayHelper::map(\app\models\Periodo::find()->all(), 'id', 'codigo'), ['prompt'=>'Selecione']);
    ?>


    <!-- preenchendo o campo solicitante_id com os ids do Aluno, e escondendo do formulario. caso seja coordenador que esteja criando uma solicitação pro Aluno, então o Coordenador preencherá.-->
    <!--<?= $form->field($model, 'solicitante_id')->textInput() ?>-->
    <?php

    if(isset(Yii::$app->user->identity))
    {


        if(Yii::$app->user->identity->perfil == 'Aluno')
        {

            echo $form->field($model, 'solicitante_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false);

        }

        elseif(Yii::$app->user->identity->perfil == 'Coordenador')
        {

            echo $form->field($model, 'solicitante_id')->dropDownList(ArrayHelper::map(\app\models\Usuario::find()->all(), 'id', 'name'), ['prompt'=>'Selecione']);

        }

    }

    ?>


    <!--preenchendo o campo aprovador_id com os ids de coordenador ou secretaria, e escondendo do formulario.-->
    <!--<?= $form->field($model, 'aprovador_id')->textInput() ?>-->
    <?php

    if(isset(Yii::$app->user->identity))
    {


        if(Yii::$app->user->identity->perfil == 'Coordenador')
        {

            echo $form->field($model, 'aprovador_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false);

        }

        if(Yii::$app->user->identity->perfil == 'Secretaria')
        {

            echo $form->field($model, 'aprovador_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false);

        }

    }

    ?>


    <?= $form->field($model, 'anexo_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>