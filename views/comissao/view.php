<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comissao */

$this->title = 'Avaliador';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=comissao/index"><i class="fa fa-calendar"></i> Comissão Monitoria</a></li>
        <li class="active"><a href="?r=comissao/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="comissao-view box-body">

    <p>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você realmente deseja deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'idProfessor',
            'usuario.name',
        ],
    ]) ?>

    </div>
</div>
</section>
