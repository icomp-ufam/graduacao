<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitacões';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            'descricao',
            'dtInicio',
            'dtTermino',
            'horasComputadas',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
