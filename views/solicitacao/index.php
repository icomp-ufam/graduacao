<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações';
?>

<?php
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/dataTables.bootstrap.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.dataTables.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/initTable.js');

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/dataTables.bootstrap.css');

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/jquery.dataTables.css');


?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=solicitacao/index"><i class="fa fa-download"></i> Solicitações</a></li>
        <li class="active"><a href="?r=solicitacao/index">Lista</a></li>
    </ol>
</section>
<section class="content">
 <div class="box box-success">
     <div class="solicitacao-index box-body">

     <?=Html::beginForm(['solicitacao/submit'],'post');?>

         <p>
            Selecione o filtro:
            <?= Html::activeDropDownList($searchModel, 'id', ['', 'Aberto','Submetida', 'Deferida', 'Indeferida', 'Arquivada','Todas'] ) ?>
         </p>

         <hr/>

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

         <hr/>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $dataProvider,
                'summary' => '',
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '', 'dateFormat'=>'dd/MM/yyyy'],

                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function ($dataProvider, $key, $index, $column) {
                            return ['value' => $dataProvider['id']];
                        }
                    ],
                    'id',
                    Yii::$app->user->identity->perfil == 'Aluno' ? ['value'=>''] : 'name',
                    'descricao',
                    [
                        'attribute' => 'dtInicio',
                        'format'    => 'date',
                        'value'     => 'dtInicio'
                    ],
                    [
                        'attribute' => 'dtTermino',
                        'format'    => 'date',
                        'value'     => 'dtTermino'
                    ],
                    'horasComputadas',
                    'status',
                    //
                    ['class' => 'yii\grid\ActionColumn', 'template' =>  Yii::$app->user->identity->perfil == 'Secretaria' ? '{view}{update}' : '{view}{update}{delete}']
                ],
            ]); ?>

    <?= Html::endForm();?> 
    </div>
</div>
</section>