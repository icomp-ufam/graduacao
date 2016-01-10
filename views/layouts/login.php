<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use kartik\icons\Icon;
Icon::map($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition login-page">
       
        <?php $this->beginBody() ?>
   
        <div id="container">
            <?= $content ?>
        </div>
 
        <?php $this->endBody() ?>
         

         <div class="backstretch" style="left: 0px; top: 0px; opacity:0.5; overflow: hidden; margin: 0px; padding: 0px; z-index: -999999; position: fixed; background-color: rgb(0, 166, 90);">
            <img src="ufam1.jpg" width="1920"></div>
    </body>
    <!-- Scripts -->
</html>
<?php $this->endPage() ?>