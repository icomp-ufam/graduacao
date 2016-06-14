<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Frequencia */

$this->title = 'Atualizar Frequência';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li><?= Html::a('&nbsp;&nbsp;Frequências', ['/frequencia/index', 'id' => $model->IDMonitoria], ['class' => 'fa fa-calendar']); ?></li>
        <li><?= Html::a('&nbsp;&nbsp;Lista', ['/frequencia/minhasfrequencias', 'id' => $model->IDMonitoria], ['class' => 'fa fa-list-alt']); ?></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="frequencia-update box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>
</div>
</section>
