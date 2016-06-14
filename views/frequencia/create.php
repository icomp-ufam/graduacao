<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Frequencia */

$this->title = 'Cadastrar Frequência';
?>

<section class="content">
<div class="box box-success">    
    <div class="frequencia-create box-body">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

    </div>
</div>
</section>
