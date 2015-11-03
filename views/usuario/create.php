<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Novo Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-4"></div>
    
    <div class="col-md-4">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>        
    </div>

    <div class="col-md-4"></div>


</div>
