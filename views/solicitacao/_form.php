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
/* @var $searchModel app\models\AtividadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="col-md-6">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'autocomplete'=>'off'],
            //'enableAjaxValidation' => true,
            //'validationUrl' => 'validation-rul',
    ]); ?>

        <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dtInicio')->widget(\yii\jui\DatePicker::classname(), [
            'options' => ['class' => 'form-control', 'disable'=>'disabled'],
            'language' => 'pt-BR',
            'dateFormat' => 'dd-MM-y',
            'clientOptions' => [
                'maxDate' => 0,
            ],
        ]) ?>

        <?= $form->field($model, 'dtTermino')->widget(\yii\jui\DatePicker::classname(), [
            'options' => ['class' => 'form-control'],
            'language' => 'pt-BR',
            'dateFormat' => 'dd-MM-y',
            'clientOptions' => [
                'maxDate' => 0,
            ],
        ]) ?>

        <!-- Atividades -->

        <?php 
		/*	$data = Atividade::find()
				->select(["CONCAT(codigo, ' ', nome) as value", "CONCAT(codigo, ' ', nome) as label","id as id"])
                ->where(['curso_id'=>Yii::$app->user->identity->curso_id])
				->asArray()
                ->all();

			echo $form->field($model, 'atividade_id')->widget(\yii\jui\AutoComplete::classname(), [
				'options' => ['class' => 'form-control'],
				'clientOptions' => [
				'source' => $data,
				],
				
			],
			['prompt'=>'Selecione',  'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('solicitacao/field').'&id=" + $(this).val(), function( data ) {
                  $( "input#maxHoras" ).val( data );
                 // $( "#divMaxHours" ).show();
                });']
			) */?>
		
		<?= $form->field($model, 'atividade_id')
            ->dropDownList(ArrayHelper::map(Atividade::find()
                ->where(['curso_id'=>Yii::$app->user->identity->curso_id])
                ->all(),
				'id', function ($element) {	return '(Máximo: '.str_pad($element['max_horas'], 2, "0", STR_PAD_LEFT). ' horas) '.$element['codigo'] . ': '. $element['nome'];}),
				
                ['prompt'=>'Selecione',  
				'onchange'=>'
                //$.post( "'.Yii::$app->urlManager->createUrl('solicitacao/field').'&id=" + $(this).val(), function( data ) {
                 // $( "input#maxHoras" ).val( data );
                 // $( "#divMaxHours" ).show();
                //});'
				]
				); ?>
       
        <?= $form->field($model, 'horasLancadas')->textInput()->hint('Este total de horas lançadas não representam as horas que serão computadas se a solicitação for deferida. As horas computadas dependem das regras definidas em cada  curso.') ?>
		<!--<?= $form->field($model, 'horasComputadas')->textInput() ?>-->
        
        <!--<div id="divMaxHours" class="form-group">
            <label id="maxHoras" class="control-label" >Máx. Horas</label>
            <input type="text" class="form-control" disabled id="maxHoras" />
        </div>-->
        
        <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true]) ?>

        <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
             <?= $form->field($model, 'solicitante_id')->dropDownList(ArrayHelper::map(\app\models\Usuario::find()->where(['perfil' => 'Aluno', 'isAtivo' => '1'])
                ->orderBy('name ASC')->all(), 'id', 'name'), ['prompt'=>'Selecione']); ?>
        
        <?php } ?>
        
        
		<?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>	
			<?= $form->field($model, 'status')->hiddenInput(['value' => 'Aberto'])->label(false) ?>		
		<?php }
			else if(Yii::$app->user->identity->perfil == 'Coordenador' && $model->isNewRecord){ 
		?>
			<?= $form->field($model, 'status')->hiddenInput(['value' => 'Submetida'])->label(false) ?>
		<?php }
		?>
        
        <?= $form->field($model, 'anexo_id')->hiddenInput(['value' => 0])->label(false) ?>

        <?= $form->field($model, 'arquivo')->fileInput(['value'=>'arquivo']) ?>
       

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Cancelar', ['solicitacao/index'], ['class' => 'btn btn-danger']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>

<script>
   // $( "#divMaxHours" ).hide();
    $( "#solicitacao-atividade_id" ).trigger( "change" );
    $('#solicitacao-dtinicio').on('change', function () {
        var test = $(this).datepicker('getDate');
        var testm = new Date(test.getTime());
        testm.setDate(testm.getDate());

        $("#solicitacao-dttermino").datepicker("option", "minDate", testm);

    });
</script>

