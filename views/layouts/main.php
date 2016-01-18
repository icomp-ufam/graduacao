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
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <?php $this->beginBody() ?>
        <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><small>ICOMP</small></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Icomp</b>UFAM</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            
          </div>
        </nav>
      </header>
      <?php if(isset(Yii::$app->user->identity)){ ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel" style="height:60px">
            <div class="info">
                  <p>Olá, <?= Yii::$app->user->identity->name ?><br/> Seu perfil atual é: <?= Yii::$app->user->identity->perfil ?></p> 
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
           
            <?php if(Yii::$app->user->identity->isAdmin == 1){ ?>
              <li class="treeview">
                <a href="?r=curso/index">
                  <i class="fa fa-check fa-fw"></i>
                  <span>Curso</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=periodo/index">
                  <i class="fa fa-calendar fa-fw"></i>
                  <span>Período</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=usuario/index">
                  <i class="fa fa-user fa-fw"></i>
                  <span>Usuários</span> 
                </a>
              </li>
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>
               <li class="treeview">
                <a href="?r=dashboard/index">
                  <i class="fa fa-dashboard fa-fw"></i>
                  <span>Dashboard</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=solicitacao/index">
                  <i class="fa fa-download fa-fw"></i>
                  <span>Solicitações</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=grupo/index">
                  <i class="fa fa-users fa-fw"></i>
                  <span>Grupos</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=atividade/index">
                  <i class="fa fa-tasks fa-fw"></i>
                  <span>Atividades</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=solicitacao/relatorio">
                  <i class="fa fa-line-chart fa-fw"></i>
                  <span>Relatório</span> 
                </a>
              </li>
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Secretaria'){ ?>
                <li class="treeview">
                <a href="?r=dashboard/index">
                  <i class="fa fa-dashboard fa-fw"></i>
                  <span>Dashboard</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=solicitacao/index">
                  <i class="fa fa-download fa-fw"></i>
                  <span>Solicitações</span> 
                </a>
              </li>
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>
               <li class="treeview">
                <a href="?r=dashboard/index">
                  <i class="fa fa-dashboard fa-fw"></i>
                  <span>Dashboard</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=solicitacao/index">
                  <i class="fa fa-download fa-fw"></i>
                  <span>Solicitações</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-line-chart fa-fw"></i>
                  <span>Relatório</span> 
                </a>
              </li>
            <?php } ?>
            <li class="treeview">
                <a href="?r=login/logout">
                  <i class="fa fa-sign-out fa-fw"></i>
                  <span>Logout</span> 
                </a>
              </li>         
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <?php } ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         
          <?= $content ?>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versão</b> 1.0.0
        </div>
        Sistema Desenvolvido no Contexto da Disciplina ICC410 - ICOMP - UFAM
      </footer>

    </div><!-- ./wrapper -->

    <script>
      $(window).bind('load resize', function() {
            var topOffset = 100;
            var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
            height = height - topOffset;

            if (height < 1){
              height = 1;
            }   
            if (height > topOffset) {
              $('.content-wrapper').css('min-height', (height) + 'px');
            }
        });

      $(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("?"));
     console.log(pgurl);
       $("ul li a").each(function(){
            if($(this).attr("href") == pgurl)
            $(this).parent().addClass("active");
       })
      });
       // $(window).trigger('load');
    </script>
        
        <?php $this->endBody() ?>
    </body>
    <!-- Scripts -->
</html>
<?php $this->endPage() ?>