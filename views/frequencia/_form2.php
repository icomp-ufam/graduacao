<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
?>

<section class="content">
<div class="box box-success">    
    <div class="modalimprimirfrequencias-form box-body">

    	<div class="col-md-4">
    	<?php $form = ActiveForm::begin(['method' => 'post', 'action' => Url::to(['frequencia/modalimprimirfrequencias', 'idmonitoria' => $idmonitoria])]); ?>

			<?= Html::hiddenInput('idmonitoria', $idmonitoria) ?>

			<div class="row">
				<?= Html::dropDownList('mes', null, $arrayMeses);?>
			</div>
			</br>
			<div class="row">
				<?= Html::dropDownList('ano', null, $arrayAnos);?>
			</div>
			</br>
			<div class="row">
				<?= Html::submitButton('Imprimir', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'Imprimir']);?>
			</div>

		<?php ActiveForm::end(); ?>
		</div>
    </div>
</div>
</section>