<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Períodos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cadastrar Período', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'dtInicio',
            'dtTermino',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
