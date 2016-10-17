<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Alunos';
?>

<section class="content-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li><a href="?r=usuario/alunos"><i class="fa fa-user"></i> Alunos</a></li>
        <li class="active"><a href="?r=usuario/alunos">Lista</a></li>
        </ol>
</section>

<section class="content">
<div class="box box-success">
    <div class="usuario-index box-body">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--        <p>
            <?= Html::a('Novo Aluno', ['create'], ['class' => 'btn btn-success']) ?>
        </p>-->

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
	    'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                'name',
                'cpf',
                'email:email',
                'matricula',

              //  ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
</section>