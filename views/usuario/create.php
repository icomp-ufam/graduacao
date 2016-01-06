<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Novo Usuário';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
       <li><a href="?r=usuario/index"><i class="fa fa-user"></i> Usuários</a></li>
        <li class="active"><a href="?r=usuario/view">Cadastro</a></li>
    </ol>
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