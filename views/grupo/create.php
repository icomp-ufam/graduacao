<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = 'Cadastro de Grupo';

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=grupo/index"><i class="fa fa-users"></i> Grupo</a></li>
        <li class="active"><a href="?r=grupo/create">Cadastro</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="grupo-create box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>
