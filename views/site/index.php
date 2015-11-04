<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $model app\models\Usuario */

?>
<!-- /.navbar-top-links -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group">
                                    Olá, 
                                    <b><?= Yii::$app->user->identity->name ?></b>
                                    , você está logado como: 
                                    <b><?= Yii::$app->user->identity->perfil ?></b>
                                </div>
                                <!-- /input-group -->
                            </li>

                        <!-- Menu do admin -->
                        <?php 
                            if(isset(Yii::$app->user->identity))
                            {
                                if( Yii::$app->user->identity->isAdmin==1)
                                { 
                        ?> 
                           <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="?r=curso/index" ><i class="fa fa-check fa-fw"></i> Curso</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-download fa-fw"></i> Solicitações</a>
                            </li>
                            <li>
                                <a href="?r=periodo/index"><i class="fa fa-calendar fa-fw"></i> Período</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Grupos</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tasks fa-fw"></i> Atividades</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa fa-line-chart fa-fw"></i> Relatório</a>
                            </li>
                            <li>
                                <a href="?r=curso/index"><i class="fa fa-file-text fa-fw"></i> Relação de Atividades</a>
                            </li>

                        <?php
                            }
                        }
                        ?>
                             <li>
                                <a href="?r=site/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>


                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>