<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Periodo */

$this->title = 'Cadastro de Período';
$this->params['breadcrumbs'][] = ['label' => 'Periodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container-fluid">

       <div class = "row">

           <div class = "col-md-4">

           </div>
           <div class = "col-md-4">
               <?= $this->render('_form', [
                   'model' => $model,
               ]) ?>
           </div>
           <div class = "col-md-4">

           </div>

       </div>

   </div>

</div>
