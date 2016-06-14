<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DisciplinaSearch;
use app\models\CursoSearch;
use app\models\UsuarioSearch;

/* @var $this yii\web\View */
/* @var $model app\models\DisciplinaPeriodo */

$this->title = 'Nova Oferta Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=disciplina-periodo/index"><i class="fa fa-calendar"></i> Oferta Monitoria</a></li>
        <li class="active"><a href="?r=disciplina-periodo/create">Cadastro</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="disciplina-periodo-create box-body">

    <?= $this->render('_form', ['model' => $model, 'arrayDisciplinas' => $arrayDisciplinas,]) ?>

    </div>
</div>
</section>
