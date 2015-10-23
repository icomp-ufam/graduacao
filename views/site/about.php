<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bem vindo: </h1> 
                    <h2>
                        <?php
                            echo Yii::$app->user->identity->name
                        ?>
                    </h2>
                <br>
                <h1>Email: </h1> 
                    <h2>
                        <?php
                            echo Yii::$app->user->identity->email
                        ?>
                    </h2>
            </div>
        </div>
    </div>
</div>
