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
            <div class="navbar-header" >
                 <div class="nav navbar-nav navbar-right">
                    <a class="brand-icomp" href="#" style=" position: fixed; top:0px; left:55px">
                    <img id="logo-icomp" src="icomp-logo.png" width="150"></div>
                </a>
                </div>

                <div class="nav navbar-nav navbar-right">
                    <a class="brand-ufam" href="#" style="position: fixed; top:0px; left:85%;">
                        <img id="logo-ufam" src="ufam-logo.png" width="90"></div>
                    </a>
                </div>
                
            </div>

            <?= $content ?>
        </div>
 
        <?php $this->endBody() ?>
         

         <div class="backstretch" style="left: 0px; top: 0px; opacity:0.5; overflow: hidden; margin: 0px; padding: 0px; z-index: -999999; position: fixed; background-color: rgb(0, 166, 90);">
            <img id="imgbg" src="ufam1.jpg" width="1920"></div>

        <script type="text/javascript">
            
            $(window).bind('load resize', function() {
                
                  $('#imgbg').attr('width', this.window.innerWidth + 'px');
                  $('#imgbg').attr('height', this.window.innerHeight + 'px');
                    
            });
        </script>
    </body>
    <!-- Scripts -->
</html>
<?php $this->endPage() ?>