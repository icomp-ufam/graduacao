<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Atividade */

$this->title = 'Cadastro de Atividade';

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=atividade/index"><i class="fa fa-tasks"></i> Atividades</a></li>
        <li class="active"><a href="?r=atividade/create">Cadastro</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">
<div class="atividade-create box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
 </section>
