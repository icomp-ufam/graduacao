<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = 'Editar Solicitação: ' . ' ' . $model->id;

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
<section class="content">
<div class="solicitacao-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</section>