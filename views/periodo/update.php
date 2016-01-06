<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Periodo */

$this->title = $model->codigo;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=periodo/index"><i class="fa fa-calendar"></i> Período</a></li>
        <li class="active"><a href="?r=periodo/update">Editar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success"> 
<div class="periodo-update box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>