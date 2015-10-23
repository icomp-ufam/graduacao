<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => 'Controle de Atividades Acadêmicas',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        [
            'label' => 'Página Inicial',
            'url' => ['site/index'],
        ],
        [
            'label' => 'Usuário',
            'items' => [
                 ['label' => 'Cadastro', 'url' => ['usuario/create'] ],
                 ['label' => 'Lista', 'url' => ['usuario/index'] ],
            ],
        ],
        [
            'label' => 'Login',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
        [
            'label' =>  '[' . Yii::$app->user->identity->name . ']',
            'visible' => !Yii::$app->user->isGuest,
            
            'items' => [
                ['label' => 'Perfil', 'url' => '?r=usuario/view&id=' .  Yii::$app->user->identity->id ],
                 
                [
                    'label' => 'Sair', 
                    'url' => ['site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
            ],
        ],       
    ],

    ]);
    
    
    // -- fim do NAVBAR MENU -- //
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;ICOMP <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
