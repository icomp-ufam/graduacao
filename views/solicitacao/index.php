<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações';
?>

<?php
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.dataTables.js',['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/dataTables.bootstrap.js',['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/initTable.js');
    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/dataTables.bootstrap.css');
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
        <div class="row">
            <div class="col-xs-4">     
                <?php if(Yii::$app->user->identity->perfil == 'Coordenador' || Yii::$app->user->identity->perfil == 'Aluno'){ ?>
                     <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
                <?php } ?>
            </div>

            <div class="col-xs-8"> 
                <div class="pull-right">       
                    <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
                        <?= Html::submitButton('Arquivar ', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'Arquivar']) ?>
                        <?= Html::submitButton('Indeferir ', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'Indeferir']) ?>
                        <?= Html::submitButton('Deferir ', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'Deferir']) ?>
                    <?php } ?>

                    <?php if(Yii::$app->user->identity->perfil == 'Secretaria'){ ?>
                        <?= Html::submitButton('Indeferir ', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'Indeferir']) ?>
                        <?= Html::submitButton('Pré-aprovar ', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'PreAprovar']) ?>
                    <?php } ?>
                                 
                    <?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>
                        <?= Html::submitButton('Submeter', ['class' => 'btn btn-info', 'name' => 'action', 'value' => 'Submeter']);?>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <hr/>

        <label>Selecione o filtro:</label>  
            
       <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
        <?= Html::activeDropDownList($searchModel, 'id', ['Pre-aprovada','Submetida', 'Deferida', 'Indeferida', 'Arquivada', 'Todas'] ) ?>
       <?php } ?>

       <?php if(Yii::$app->user->identity->perfil == 'Secretaria'){ ?>
        <?= Html::activeDropDownList($searchModel, 'id', ['Submetida','Pre-aprovada', 'Deferida', 'Indeferida', 'Arquivada', 'Todas'] ) ?>
       <?php } ?>
       
       <?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>
        <?= Html::activeDropDownList($searchModel, 'id', ['Aberto','Submetida', 'Deferida', 'Indeferida', 'Arquivada', 'Todas'] ) ?>
       <?php } ?> 

         <hr/>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '', 'dateFormat'=>'dd/MM/yyyy'],
                'tableOptions' => ['class' => 'table  table-bordered table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function ($dataProvider, $key, $index, $column) {
                            return ['value' => $dataProvider['id']];
                        }
                    ],

                    Yii::$app->user->identity->perfil == 'Aluno' ? 'id' : ['attribute'=>'Aluno', 'value'=>'name'],

                    ['attribute'=>'Descricao', 'value'=>'descricao'],
                    [
                        'attribute' => 'Inicio',
                        'format'    => 'date',
                        'value'     => 'dtInicio'
                    ],
                    [
                        'attribute' => 'Termino',
                        'format'    => 'date',
                        'value'     => 'dtTermino'
                    ],
                    ['attribute'=>'Horas Solicitadas', 'value'=>'horasComputadas'],
                    'status',
                    //
                    ['class' => 'yii\grid\ActionColumn',
                        'template' =>  Yii::$app->user->identity->perfil == 'Secretaria' ? '{view}{update}' : '{view}{update}{delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return \yii\helpers\Html::a('<span class="label label-primary"><i class=" fa fa-pencil"></i></span>&nbsp;',
                                    (new yii\grid\ActionColumn())->createUrl('solicitacao/update', $model, $model['id'], 1), [
                                        'title' => Yii::t('yii', 'Editar'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                            },
                            'delete' => function ($url, $model) {
                                return \yii\helpers\Html::a('<span class="label label-danger"><i class=" fa fa-trash"></i></span>',
                                    (new yii\grid\ActionColumn())->createUrl('solicitacao/delete', $model, $model['id'], 1), [
                                        'title' => Yii::t('yii', 'Apagar'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                            },
                            'view' => function ($url, $model) {
                                return \yii\helpers\Html::a('<span class="label label-success"><i class=" fa fa-search"></i>&nbsp;</span>&nbsp;',
                                    (new yii\grid\ActionColumn())->createUrl('solicitacao/view', $model, $model['id'], 1), [
                                        'title' => Yii::t('yii', 'Ver'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                            },


                        ]
                    ],

                ],
            ]); ?>

    <?= Html::endForm();?> 
    </div>
</div>
</section>