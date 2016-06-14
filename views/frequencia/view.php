<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Frequencia */

$this->title = 'Frequência do dia: ' . $model->dmy;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li><?= Html::a('&nbsp;&nbsp;Frequências', ['/frequencia/index', 'id' => $model->id], ['class' => 'fa fa-calendar']); ?></li>
        <li><?= Html::a('&nbsp;&nbsp;Lista', ['/frequencia/minhasfrequencias', 'id' => $model->id], ['class' => 'fa fa-list-alt']); ?></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="frequencia-view box-body">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza de que quer deletar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'IDMonitoria',
            'dmy',
            'ch',
            'atividade',
        ],
    ]) ?>

    </div>
</div>
</section>