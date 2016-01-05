<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->title = 'Lista de Cursos';
?>
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

  
    <section class="content">
        <div class="box box-success">
        <div class="curso-index box-body">
    
            <p>
                <?= Html::a('Novo Curso', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'columns' => [
                    'codigo',
                    'nome',
                    'max_horas',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        </div>
      </section><!-- /.content -->
  
    
