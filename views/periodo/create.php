<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
$this->title = 'Cadastro de Período';
$this->params['breadcrumbs'][] = ['label' => 'Periodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="periodo-create">
  <h1><?= Html::encode($this->title) ?></h1>
  
  <?= $this->render('_form', [
  'model' => $model,
  ]) ?>
  
</div>
</section>