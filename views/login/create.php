<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Novo Usuário';
?>
<div class="col-md-4"></div>
<div class="col-xs-12 col-md-4">
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>
<section class="content">
<div class="box box-success"> 
<div class="usuario-create box-body">

   
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>        
   


</div>
</div>
</section>
</div>
<div class="col-md-4"></div>