<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Periodo */

$this->title = 'Cadastro de Calendário';
$this->params['breadcrumbs'][] = ['label' => 'Periodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">

       <div class = "row">

           <div class = "col-md-4">
               <h3>Preencha os campos abaixo para cadastrar um calendário acadêmico.<br/>Todos os campos devem ser preenchidos.</h3>
               <?= $this->render('_form', [
                   'model' => $model,
               ]) ?>

           </div>
           <div class = "col-md-3">


           </div>
           <div class = "col-md-3">


           </div>
           <div class = "col-md-3">


           </div>

       </div>

   </div>

</div>
