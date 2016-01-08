<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = 'Editar Curso';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
    	<li><a href="?r=curso/index"><i class="fa fa-check"></i> Curso</a></li>
        <li class="active"><a href="?r=curso/update">Editar</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-success">
	<div class="curso-update box-body">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
	</div>
</section><!-- /.content -->