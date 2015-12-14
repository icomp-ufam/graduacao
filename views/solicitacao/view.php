<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'dtInicio',
            'dtTermino',
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
