<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = $model->descricao;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=solicitacao/index"><i class="fa fa-download"></i> Solicitações</a></li>
        <li class="active"><a href="?r=solicitacao/view">Visualizar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success"> 
<div class="solicitacao-view box-body">


    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja excluir  a solicitação?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descricao',
            [
                'attribute' => 'dtInicio',
                'format'    => 'raw',
                'value'     => Yii::$app->formatter->asDate($model->dtInicio, 'php:d-m-Y')
            ],
            [
                'attribute' => 'dtTermino',
                'format'    => 'raw',
                'value'     => Yii::$app->formatter->asDate($model->dtTermino, 'php:d-m-Y')
            ],
            'horasComputadas',
            'status:html',

            [
            'attribute'=>'anexoOriginalName',
            'format'=>'raw',
            'value'=>Html::a($model->anexoOriginalName, 'uploads/' . $model->anexoHashName ),
            ],

        ],
    ]) ?>

</div>
</div>
</section>