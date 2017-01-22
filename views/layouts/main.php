<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use kartik\icons\Icon;
use app\models\Usuario;
use app\models\Comissao;
use app\models\Curso;
use app\models\UsuarioCurso;
use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

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
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="icomp-logo.png" width="88" /></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">

              <script>
                  $(function(){
                      $(document).on("change", "#meuSelect", function(){

                          var e = document.getElementById("meuSelect");
                          var a = e.options[e.selectedIndex].id;

                          $.ajax({
                              url: '<?php echo Url::to(['usuario/alterar']); ?>',
                              type:'POST',
                              data:{'curso': a},
                              success: function (data) {
                                  alert(data);
                              }
                          });

                      });

                  });
              </script>
            <?php
              if(Yii::$app->user->identity->perfil == "Coordenador"){
              echo "<select  id=\"meuSelect\" class=\"btn btn-success selectMain\">";

                  $usuario = Yii::$app->user->identity->id;
                  $usuarioCursos = UsuarioCurso::find()->where(['usuario' => $usuario])->all();

                  echo "<option>Selecionar Curso</option>";
                  foreach ($usuarioCursos as $uc) {
                      $curso = Curso::findOne($uc);
                      echo "<option id=" . $curso->id . "'>" . $curso->nome . "</option>";
                  }
              echo "</select>";
              }
            ?>
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
                  <p>Olá, <?= Yii::$app->user->identity->name ?><br/> Seu perfil atual é: <?= Yii::$app->user->identity->perfil ?>
				  <?php

                  if(Yii::$app->user->identity->perfil == "Coordenador" || Yii::$app->user->identity->perfil == "Aluno" ) {
                      if (Yii::$app->user->identity->curso_id) {
                          $idUsuario = Yii::$app->user->identity->id;
                          $usuario = Usuario::findOne($idUsuario);
                          $curso = Curso::findOne($usuario->curso_id);
                          echo "<br/>de " .$curso->nome;
                      }
                  }

				  ?>
				  </p> 
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
           
            <?php if(Yii::$app->user->identity->isAdmin == 1){ ?>
              <li class="treeview">
                <a href="?r=curso%2Findex">
                  <i class="fa fa-check fa-fw"></i>
                  <span>Curso</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=grupo%2Findex">
                 <i class="fa fa-users fa-fw"></i>
                 <span>Grupos</span> 
               </a>
              </li>
              <li class="treeview">
                <a href="?r=periodo%2Findex">
                  <i class="fa fa-calendar fa-fw"></i>
                  <span>Período</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=usuario%2Findex">
                  <i class="fa fa-user fa-fw"></i>
                  <span>Usuários</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=disciplina%2Findex">
                  <i class="fa fa-book fa-fw"></i>
                  <span>Disciplinas</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=disciplina-periodo%2Findex">
                  <i class="fa fa-folder-open fa-fw"></i>
                  <span>Oferta Monitoria</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=comissao%2Findex">
                  <i class="fa fa-users fa-fw"></i>
                  <span>Comissão Monitoria</span> 
                </a>
              </li>	
              <li class="treeview">
                <a href="?r=monitoria%2Fsecretaria">
                  <i class="fa fa-clone fa-fw"></i>
                  <span>Gerenciar Monitorias</span> 
                </a>
              </li>
			  
            <?php } ?>
			
			
			 <?php if(Yii::$app->user->identity->perfil == 'Professor'){ ?>

					<?php 
          $professor = Usuario::findOne(['CPF' => Yii::$app->user->identity->cpf]);
          $comissao = Comissao::findOne(['idProfessor' => $professor->id]);
          if ($comissao != null && $comissao->idProfessor != null) { ?>
          <li class="treeview">
  					<a href="?r=monitoria%2Favaliador">
  					<i class="fa fa-check fa-fw"></i>
  					<span>Julgar Monitorias</span> 
  					</a>
  				</li>
  				<?php } ?>

  				<li class="treeview">
  					<a href="?r=monitoria%2Fprofessor">
  					<i class="fa fa-clone fa-fw"></i>
  					<span>Gerenciar Monitorias</span> 
  					</a>
  				</li>
        <?php } ?>
		
        <?php if(Yii::$app->user->identity->perfil == 'Coordenador'){ ?>

          <?php 
          $professor = Usuario::findOne(['CPF' => Yii::$app->user->identity->cpf]);
          $comissao = Comissao::findOne(['idProfessor' => $professor->id]);
          if ($comissao != null && $comissao->idProfessor != null) { ?>
          <li class="treeview">
            <a href="?r=monitoria%2Favaliador">
            <i class="fa fa-check fa-fw"></i>
            <span>Julgar Monitorias</span> 
            </a>
          </li>
          <?php } ?>

           <li class="treeview">
            <a href="?r=dashboard%2Findex">
              <i class="fa fa-dashboard fa-fw"></i>
              <span>Dashboard</span> 
            </a>
          </li>
          <li class="treeview">
            <a href="?r=monitoria%2Fprofessor">
            <i class="fa fa-clone fa-fw"></i>
            <span>Gerenciar Monitorias</span> 
            </a>
          </li>
          <li class="treeview">
            <!--<a href="?r=solicitacao%2Findex">-->
			<a href="?r=solicitacao%2Findex&SolicitacaoSearch%5Bstatus%5D=Pre-aprovada">
              <i class="fa fa-download fa-fw"></i>
              <span>Solicitações</span> 
            </a>
          </li>
          <li class="treeview">
            <a href="?r=atividade%2Findex">
              <i class="fa fa-tasks fa-fw"></i>
              <span>Atividades</span> 
            </a>
          </li>
          <li class="treeview">
            <a href="?r=solicitacao%2Frelatorio">
              <i class="fa fa-line-chart fa-fw"></i>
              <span>Relatório</span> 
            </a>
          </li>
        <?php } ?>

        <?php if(Yii::$app->user->identity->perfil == 'Secretaria'){ ?>
              <li class="treeview">
                <a href="?r=periodo%2Findex">
                  <i class="fa fa-calendar fa-fw"></i>
                  <span>Período</span> 
                </a>
              </li>
              <li class="treeview">
                <!--<a href="?r=solicitacao%2Findex">-->
				<a href="?r=solicitacao%2Findex&SolicitacaoSearch%5Bstatus%5D=Submetida">
                  <i class="fa fa-download fa-fw"></i>
                  <span>Solicitações</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=disciplina%2Findex">
                  <i class="fa fa-book fa-fw"></i>
                  <span>Disciplinas</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=disciplina-periodo%2Findex">
                  <i class="fa fa-folder-open fa-fw"></i>
                  <span>Oferta Monitoria</span> 
                </a>
              </li>
			        <li class="treeview">
                <a href="?r=comissao%2Findex">
                  <i class="fa fa-users fa-fw"></i>
                  <span>Comissão Monitoria</span> 
                </a>
              </li>			  
              <li class="treeview">
                <a href="?r=monitoria%2Fsecretaria">
                  <i class="fa fa-clone fa-fw"></i>
                  <span>Gerenciar Monitorias</span> 
                </a>
              </li>
			  
            <?php } ?>
            <?php if(Yii::$app->user->identity->perfil == 'Aluno'){ ?>
               <li class="treeview">
                <a href="?r=dashboard%2Findex">
                  <i class="fa fa-dashboard fa-fw"></i>
                  <span>Dashboard</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=solicitacao%2Findex">
                  <i class="fa fa-download fa-fw"></i>
                  <span>Solicitações</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=monitoria%2Fcreate">
                  <i class="fa fa-pencil fa-fw"></i>
                  <span>Inscrever Monitoria</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?r=monitoria%2Faluno">
                  <i class="fa fa-database fa-fw"></i>
                  <span>Minhas Monitorias</span> 
                </a>
              </li>
			  
            <?php } ?>
              <li class="treeview">
                  <a href="?r=usuario/trocasenha">
                      <i class="fa fa-key fa-fw"></i>
                      <span>Alterar Dados da Conta</span>
                  </a>
              </li>
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
          <!--<?= Alert::widget() ?>-->
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
        var start = window.location.href.lastIndexOf("?");
        var pgurl = window.location.href.substr(start);
        console.log(pgurl);
        $("ul li a").each(function(){
            if($(this).attr("href") === pgurl)
            $(this).parent().addClass("active");
        })
      });
        
    </script>
        
        <?php $this->endBody() ?>
    </body>
    <!-- Scripts -->
</html>
<?php $this->endPage() ?>