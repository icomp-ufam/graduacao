<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = 'Cadastro de Curso';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=curso/index"><i class="fa fa-check"></i> Curso</a></li>
        <li class="active"><a href="?r=curso/create">Cadastro</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">	
<div class="curso-create box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
 </section>
