<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Solicitar Nova Senha';
?>
<div class="col-md-4"></div>
<div class="col-xs-12 col-md-4">
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>
<section class="content">
<div class="box box-success">
	<div class=" box-body">

	<p class='col-sm-4 alert alert-success'>Nova senha enviada, verifique seu email!</p>

	</div>
	</div>
</section>