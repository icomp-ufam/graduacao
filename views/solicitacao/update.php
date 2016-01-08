<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = $model->descricao;

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=solicitacao/index"><i class="fa fa-download"></i> Solicitações</a></li>
        <li class="active"><a href="?r=solicitacao/update">Editar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success"> 
<div class="solicitacao-update box-body">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>