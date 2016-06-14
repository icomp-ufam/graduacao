<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DisciplinaPeriodo */
/* @var string $etapa */
/* @var string $erroFatal */
/* @var array[] $erros */

$this->title = 'Importar Disciplinas - Arquivo CSV';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=disciplina-periodo/index"><i class="fa fa-calendar"></i> Oferta Monitoria</a></li>
        <li class="active"><a href="?r=disciplina-periodo/index">Lista</a></li>
        <li class="active"><a href="?r=disciplina-periodo/importarcsv">Importar Disciplinas - Arquivo CSV</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="disciplina-periodo-importarcsv box-body">

	    <?= $this->render('_formimportarcsv', [
	    		'model' => $model, 
	    		'etapa' => $etapa,
	    		'erroFatal' => $erroFatal,
	    		'erros' => $erros
	    	]) ?>

    </div>
</div>
</section>
