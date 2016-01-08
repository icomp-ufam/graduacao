<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=grupo/index"><i class="fa fa-users"></i> Grupo</a></li>
        <li class="active"><a href="?r=grupo/create">Cadastro</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="grupo-index box-body">

    <p>
        <?= Html::a('Novo Grupo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            'nome',
            'max_horas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</section>