<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = $model->nome;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=grupo/index"><i class="fa fa-users"></i> Grupo</a></li>
        <li class="active"><a href="?r=grupo/view">Visualizar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="grupo-view box-body">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Voltar', ['index'], ['class' => 'btn btn-warning']) ?>
		<?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'codigo',
            'nome',
            'max_horas',
        ],
    ]) ?>

</div>
</div>
</section>