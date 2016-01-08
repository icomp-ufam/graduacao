<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Atividade */

$this->title = $model->nome;?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=atividade/index"><i class="fa fa-tasks"></i> Atividades</a></li>
        <li class="active"><a href="?r=atividade/index">Visualizar</a></li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="atividade-view box-body">

            <p>
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
                    'curso_id',
                    'grupo_id',
                ],
            ]) ?>

        </div>
    </div>
</section>
