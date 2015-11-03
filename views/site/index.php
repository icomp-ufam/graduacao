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
                                    Olá, <!--<?php $model = Usuario::findOne($id);?>--><b>Gabriel Gama</b>
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