<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações';
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
<div class="solicitacao-index">

        <?=Html::beginForm(['solicitacao/submit'],'post');?>
        <p>
            <?php if(Yii::$app->user->identity->perfil == 'Coordenador' || Yii::$app->user->identity->perfil == 'Aluno'){ ?>
                <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
            <?php } ?>

            <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
                <?= Html::submitButton('Arquivar ', ['class' => 'pull-right btn btn-primary', 'name' => 'action', 'value' => 'Arquivar']) ?>
                <?= Html::submitButton('Indeferir ', ['class' => 'pull-right btn btn-danger', 'name' => 'action', 'value' => 'Indeferir']) ?>
                <?= Html::submitButton('Deferir ', ['class' => 'pull-right btn btn-success', 'name' => 'action', 'value' => 'Deferir']) ?>
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Secretaria'){ ?>
                <?= Html::submitButton('Pré-aprovar ', ['class' => 'pull-right btn btn-success', 'name' => 'action', 'value' => 'PreAprovar', 'style' => 'margin-bottom: 10px']) ?>
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>
                <?= Html::submitButton('Submeter', ['class' => 'pull-right btn btn-info', 'name' => 'action', 'value' => 'Submeter']);?>
            <?php } ?>
            
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
         //   'filterModel' => $searchModel,
            'summary' => '',
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                'id',
                'solicitante_id',
                'descricao',
                 [
                    'attribute' => 'usuario',
                    'value' => ''
                ],
                //'dtInicio',
                //'dtTermino',
                'horasComputadas',
                'status',
                ['class' => 'yii\grid\ActionColumn', 'template' =>  Yii::$app->user->identity->perfil == 'Secretaria' ? '{view}{update}' : '{view}{update}{delete}']
            ],
        ]); ?>

<?= Html::endForm();?> 
</div>
</section>