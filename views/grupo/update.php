<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = $model->nome;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=grupo/index"><i class="fa fa-users"></i> Grupo</a></li>
        <li class="active"><a href="?r=grupo/update">Editar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="grupo-update box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>