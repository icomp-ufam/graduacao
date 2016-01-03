<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = 'Editar Curso';
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar Curso';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    	<li><a href="#">Examples</a></li>
    	<li class="active">Blank page</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="curso-update">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>
</section><!-- /.content -->