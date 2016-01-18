<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->name;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=usuario/index"><i class="fa fa-user"></i> Usuários</a></li>
        <li class="active"><a href="?r=usuario/view">Visualizar</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success"> 
<div class="usuario-view box-body">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você deseja deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'cpf',
            'email:email',
            //'password',
            'matricula',
            'siape',
            'curso_id',
            //'dtEntrada',
            //'isAdmin',
            //'isAtivo',
            //'auth_key',
            //'password_reset_token',
        ],
    ]) ?>

</div>
</div>
</section>