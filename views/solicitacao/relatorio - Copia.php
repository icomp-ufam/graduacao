<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use app\models\Periodo;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = 'Relatório';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=solicitacao/index"><i class="fa fa-download"></i> Solicitações</a></li>
        <li class="active"><a href="?r=solicitacao/view">Visualizar</a></li>
    </ol>
</section>
 <label>Selecione o período:</label>  
            
 <?= Html::dropDownList('periodo', ['2015/01', '2015/02','2016/01', '2016/02'] ) ?>

 
<section class="content">

    <div class="box box-success">
        <div class="box-header">
            <h4>Clique em cima da matricula para copiar para a área de transfêrencia.</h4>
        </div>
        <div class="solicitacao-view box-body">

            <!--<table class="table table-hover table-bordered">
                <thead>
                    <th>Aluno</th>
                    <th>Matricula</th>
                    <th>Período</th>
                    <th>Ensino</th>
                    <th>Pesquisa</th>
                    <th>Extensão</th>
                </thead>

                <?php foreach($resultado as $res) {?>
                <tr>
                    <td><?= $res['nome'] ?></td>
                    <td>
                        <a href="#">
                            <span class="fa fa-clipboard" onclick="copyToClipboard(this)"><?= $res['matricula'] ?></span>
                        </a>
                    </td>
                    <td><?= $res['periodo'] ?></td>
                    <td><?= $res['ensino'] ?></td>
                    <td><?= $res['pesquisa'] ?></td>
                    <td><?= $res['extensao'] ?></td>
                    
                </tr>
                <?php } ?>
            </table>
-->

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
                        <!--<?= Html::submitButton('Arquivar ', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'Arquivar']) ?>-->
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
            
       <?php 
			if(Yii::$app->user->identity->perfil == 'Aluno')
				//$opcoes = array ('Aberto' => 'Aberto', 'Submetida' => "Submetida", 'Pre-aprovada' => "Pre-aprovada", 'Indeferida' => "Indeferida", 'Deferida' => "Deferida", 'Arquivada' => "Arquivada");
				$opcoes = array ('Aberto' => 'Aberto', 'Submetida' => "Submetida", 'Pre-aprovada' => "Pre-aprovada", 'Indeferida' => "Indeferida", 'Deferida' => "Deferida");
			else
				//$opcoes = array ('Submetida' => "Submetida", 'Pre-aprovada' => "Pre-aprovada", 'Indeferida' => "Indeferida", 'Deferida' => "Deferida", 'Arquivada' => "Arquivada");
				$opcoes = array ('Submetida' => "Submetida", 'Pre-aprovada' => "Pre-aprovada", 'Indeferida' => "Indeferida", 'Deferida' => "Deferida");
				
			
		?>

         <hr/>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function ($dataProvider, $key, $index, $column) {
                            return ['value' => $dataProvider['id']];
                        }
                    ],
					['label' => 'Número', 'attribute'=>'id', 'value'=>'id','contentOptions' =>['style' => 'width:100px'],],
					['label' => 'Nome do Aluno', 'attribute' => 'name', 'value' => 'name', 'visible' => Yii::$app->user->identity->perfil <> 'Aluno'],
					//'atividade_id',
					['attribute'=>'atividade_id', 'label'=>'Atividade', 'value' => function ($model) {  return $model->atividade->codigo.': '.$model->atividade->nome;  }  ],
					//'grupo',
                    'descricao',
                    [
                        'attribute' => 'Inicio',
                        'format'    => ['date', 'php:d-m-Y'],
                        'value'     => 'dtInicio',
						'contentOptions' =>['style' => 'width:100px'],
                    ],
                    [
                        'attribute' => 'Termino',
                        'format'    => ['date', 'php:d-m-Y'],
                        'value'     => 'dtTermino',
						'contentOptions' =>['style' => 'width:100px'],
                    ],
                    ['label' => 'Horas Solicitadas', 'attribute'=>'horasLancadas', 'value'=>'horasLancadas','contentOptions' =>['style' => 'width:100px'],],
					['label' => 'Horas Computadas', 'attribute'=>'horasComputadas', 'value'=>'horasComputadas','contentOptions' =>['style' => 'width:100px'],],
					[   'label' => 'Status',
						'attribute' => 'status',
						'filter'=> $opcoes,
						'value' => 'status',
						'contentOptions' =>['style' => 'width:100px'],
					],
                    ['class' => 'yii\grid\ActionColumn',
                        'contentOptions' =>['style' => 'width:100px'],
						'template' =>  Yii::$app->user->identity->perfil == 'Secretaria' ? '{view}{update}{delete}' : '{view}{update}{delete}',
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
										'data-confirm'=> 'Confirmar exclusão da solicitação?'										
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

<!-- Script para Copiar para a area de transf. -->
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();

        document.execCommand("copy");

        $temp.remove();

    }
</script>