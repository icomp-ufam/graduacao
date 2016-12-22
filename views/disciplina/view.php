<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */

$this->title = $model->codDisciplina .' - '. $model->nomeDisciplina;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=disciplina/index"><i class="fa fa-calendar"></i> Disciplinas</a></li>
        <li class="active"><a href="?r=disciplina/index">Lista</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="disciplina-view box-body">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Voltar', ['index'], ['class' => 'btn btn-warning']) ?>
		<?= Html::a('<i class="fa fa-edit"></i> Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-close"></i> Deletar', ['delete', 'id' => $model->id], [
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
            'codDisciplina',
            'nomeDisciplina',
            'cargaHoraria',
            'creditos',
            //'possuiMonitoria',
            [
                'label' => 'Disciplina com Monitoria',
                'value' => $model->traducao_possui_monitoria
            ],
        ],
    ]) ?>

    </div>
</div>
</section>
