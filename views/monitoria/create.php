<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Monitoria */
/* @var string $etapa */
/* @var string $periodo */
/* @var string $matricula */
/* @var $searchModel app\models\DisciplinaMonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inscrição para Monitoria';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <?php if (Yii::$app->user->identity->perfil == 'Aluno') { ?>
        <li><a href="?r=monitoria/aluno"><i class="fa fa-pencil"></i> Monitorias</a></li>
        <li class="active"><a href="?r=monitoria/aluno">Lista</a></li>
        <?php } ?>
    </ol>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-create box-body">

    <?php if (isset($etapa) && $etapa == '1') { ?>
    <?= $this->render('_form', [
        'model' => $model,
        'etapa' => $etapa,
        'periodo' => $periodo,
        'matricula' => $matricula,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>
    <?php } ?>

    <?php if (isset($etapa) && $etapa == '2') { ?>
    <?= $this->render('_form2', [
        'model' => $model,
        'etapa' => $etapa,
        'periodo' => $periodo,
        'matricula' => $matricula,
    ]) ?>
    <?php } ?>
    
    </div>
</div>
</section>