<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atividade */

$this->title = 'Update Atividade: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
<div class="atividade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</section>
