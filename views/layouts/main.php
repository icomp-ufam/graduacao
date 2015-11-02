<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
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
    <body>
        <?php $this->beginBody() ?>
        <header style="border-bottom:1px solid #e7e7e7; padding:5px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="icomp.png" width="150px" />
                    </div>
                    <div class="col-md-8">
                        <h2 style="text-align:center;">Sistema de Atividades Complementares</h2>
                    </div>
                    <div class="col-md-2">
                        <img src="ufam.png" width="70px" />
                    </div>
                </div>
            </div>
        </header>
        
            <div id="wrapper">
                <!-- /.navbar-top-links -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group">
                                    Olá, <b>Gabriel Gama</b>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="?r=curso/index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="?r=curso/index" ><i class="fa fa-check fa-fw"></i> Curso</a>
                            </li>
                            <li>
                                <a href="?r=curso/index"><i class="fa fa-line-chart fa-fw"></i> Relatório</a>
                            </li>
                            <li>
                                <a href="?r=curso/index"><i class="fa fa-file-text fa-fw"></i> Relação de Atividades</a>
                            </li>
                            <li>
                                <a href="?r=curso/index"><i class="fa fa-file-text fa-fw"></i> Solicitações</a>
                            </li>
                            <li>
                                <a href="?r=periodo/index"><i class="fa fa-file-text fa-fw"></i> Período</a>
                            </li>
                            <li>
                                <a href="?r=site/logout"><i class="fa fa-file-text fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
                <div id="page-wrapper">
                    <?= $content ?>
                </div>
            </div>
            
        
        <footer style="text-align:center; border-top:1px solid #e7e7e7;">
            <div class="col-md-12">
                <h5>Sistema Desenvolvido no Contexto da Disciplina ICC410 - UFAM - ICOMP</h5>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
    <!-- Scripts -->
</html>
<?php $this->endPage() ?>