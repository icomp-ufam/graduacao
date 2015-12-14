<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = 'Editar Solicitação: ' . ' ' . $model->id;

?>
<div class="solicitacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
