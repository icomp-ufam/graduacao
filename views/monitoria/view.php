<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AlunoMonitoria */

$this->title = $model->codDisciplina.' - '.$model->nomeDisciplina;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <?php if (Yii::$app->user->identity->perfil == 'Aluno') { ?>
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li class="active"><a href="?r=monitoria/aluno">Lista</a></li>
        <?php } ?>
        
        <?php if (Yii::$app->user->identity->perfil == 'Secretaria') { ?>
        <li><a href="?r=monitoria/secretaria"><i class="fa fa-clone"></i> Gerenciar Monitorias / Inscrições</a></li>
        <li class="active"><a href="?r=monitoria/secretaria">Lista</a></li>
        <?php } ?>

        <?php if (Yii::$app->user->identity->perfil == 'Professor') { ?>
        <li><a href="?r=monitoria/avaliador"><i class="fa fa-check"></i> Julgar Inscrições em Monitoria</a></li>
        <li class="active"><a href="?r=monitoria/avaliador">Lista</a></li>
        <?php } ?>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-view box-body">
    
    <?php if(Yii::$app->user->identity->perfil === 'Secretaria') { ?>
        <p>
        <?= Html::a('Formulário de Inscrição', ['formularioinscricao', 'id' => $model->id], ['target'=>'_blank', 'class' => 'btn btn-primary']); ?>

        <?php if (!empty($model->pathArqPlanoDisciplina)) { ?>
            <?= Html::a('Plano Semestral da Disciplina', Url::base().'/'.$model->pathArqPlanoDisciplina, 
                [
                    'target'=>'_blank', 
                    'class'=>'btn btn-primary', 
                ]) ?>
        <?php } else { ?>
            <?= Html::a('Plano Semestral da Disciplina', '', ['class'=>'btn btn-primary', 'disabled' => true]) ?>
        <?php } ?>

        <?php if (!empty($model->pathArqRelatorioSemestral)) { ?>
            <?= Html::a('Relatório Semestral de Monitoria', Url::base().'/'.$model->pathArqRelatorioSemestral, 
                [
                    'target'=>'_blank', 
                    'class'=>'btn btn-primary', 
                ]) ?>
        <?php } else { ?>
            <?= Html::a('Relatório Semestral de Monitoria', '', ['class'=>'btn btn-primary', 'disabled' => true]) ?>
        <?php } ?>

        </p>
    <?php } ?>

    <?php if(Yii::$app->user->identity->perfil === 'Aluno') { ?>
        <p>
        <?php if($model->status == 'Selecionado sem bolsa' || $model->status == 'Selecionado com bolsa') { ?>
            <?= Html::a('Formulário de Inscrição', ['formularioinscricao', 'id' => $model->id], ['target'=>'_blank', 'class' => 'btn btn-primary']); ?>
            <?= Html::a('Frequências', ['/frequencia/index', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php } else { ?>
            <?= Html::a('Formulário de Inscrição', ['formularioinscricao', 'id' => $model->id], ['target'=>'_blank', 'class' => 'btn btn-primary']); ?>
            <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Você realmente deseja deletar este item?',
                    'method' => 'post',
                ],
            ]); ?>
        </p>
    <?php } } ?>

    <?php if(Yii::$app->user->identity->perfil === 'Professor') { ?>
        <p>
        <?= Html::a('Formulário de Inscrição', ['formularioinscricao', 'id' => $model->id], ['target'=>'_blank', 'class' => 'btn btn-primary']); ?>
        
        <?= Html::a('Julgar', ['julgarinscricao', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>

        </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'aluno',
            'nomeDisciplina',
            'codDisciplina',
            'professor',
            'periodo',
            'codTurma',
            [
                'label' => 'Curso da Disciplina',
                'value' => $model->nomeCurso
            ],
            [
                'label' => 'Curso do Aluno',
                'value' => $model->nomeCursoAluno
            ],
            'bolsa_traducao',
            [
                'label' => 'Histórico Escolar',
                'format'=> 'raw',
                'value' => Html::a('Visualizar', Url::base().'/'.$model->pathArqHistorico, ['target'=>'_blank'])
            ],
            'status'
        ],
        'options' => [
            'class' => 'table table-striped table-bordered detail-view',
            'style' => 'width:50%'
        ],
    ]) ?>

    </div>
</div>
</section>
