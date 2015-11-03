<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="curso-index">
    <h2>Curso</h2>
    <p>
        <?= Html::a('Cadastrar Curso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'nome',
            'max_horas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
