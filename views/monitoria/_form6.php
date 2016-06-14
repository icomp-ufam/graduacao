<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>

<section class="content">
<div class="box box-success">    
    <div class="modalselecionarperiodo-form box-body">

    	<div class="col-md-4">
    	<?php $form = ActiveForm::begin(['method' => 'post', 'action' => Url::to(['monitoria/modalfiltrorelatorio', 'funcao' => $funcao])]); ?>

			<div class="row">
				<p>Período</p>
				<?= Html::dropDownList('periodo', null, $arrayPeriodos);?>
			</div>
			</br>
			
			<?php if ($funcao == 'frequenciageral') { ?>
				<div class="row">
					<p>Mês</p>
					<?= Html::dropDownList('mes', null, 
						array(1=>'Janeiro', 2=>'Fevereiro', 3=>'Março', 4=>'Abril', 5=>'Maio', 6=>'Junho', 
							7=>'Julho', 8=>'Agosto', 9=>'Setembro', 10=>'Outubro', 11=>'Novembro', 12=>'Dezembro')
					);?>
				</div>
				</br>
				<div class="row">
					<p>Ano</p>
					<?= Html::dropDownList('ano', null, $arrayAnos);?>
				</div>
				</br>
			<?php } ?>

			<div class="row">
				<?= Html::submitButton($funcao == 'planosemestral' ? 'Continuar' : 'Gerar PDF', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'Imprimir']);?>
			</div>

		<?php ActiveForm::end(); ?>
		</div>
    </div>
</div>
</section>