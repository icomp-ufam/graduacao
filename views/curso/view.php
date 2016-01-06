<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = $model->nome;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=curso/index"><i class="fa fa-check"></i> Curso</a></li>
        <li class="active"><a href="?r=curso/view">Visualizar</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-success">   
        <div class="curso-view box-body">
            <p>
                <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Você tem certeza que deseja deletar?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'codigo',
                    'nome',
                    'max_horas',
                ],
            ]) ?>

        </div>
    </div>
</section><!-- /.content -->
