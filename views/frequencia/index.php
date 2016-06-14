<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var array $events */
/* @var string erro */

$this->title = 'Frequências';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=monitoria/aluno"><i class="fa fa-database"></i> Gerenciar Monitorias</a></li>
        <li><?= Html::a('Frequências', ['/frequencia/index', 'id' => $idMonitoria], ['class' => 'active']); ?></li>
    </ol>
</section>
<section class="content">
<div class="box box-success">    
    <div class="frequencia-index box-body">

        <?php if(Yii::$app->request->get('erro') == 2) { ?>
            <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Já existe registro nesta data. Para alteração utilize o link Visualizar em Lista."; ?></p>
            <script>
               setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
            </script>
        <?php } ?>

        <?php if(Yii::$app->request->get('erro') == 3) { ?>
            <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Frequência não registrada porque a carga horária semanal não pode ser superior a 12 horas."; ?></p>
            <script>
               setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
            </script>
        <?php } ?>

        <?php if(isset($erro) && $erro == 1) { ?>
            <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Você não está cadastrado como monitor."; ?></p>
            <script>
               setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
            </script>
        <?php } else { ?>

            <!--<div style="width: 800px; height: 150px;">-->
            <div class="col-md-7">
            <p>
                <?= Html::a('Visualizar em Lista', ['minhasfrequencias', 'id' => $idMonitoria], ['class' => 'btn btn-success']) ?>
                <?= Html::button('Imprimir Frequências', ['value' => Url::to(['frequencia/modalimprimirfrequencias', 'idmonitoria' => $idMonitoria]), 'class' => 'btn btn-success', 'id' => 'imprimirFrequenciasButton']) ?>
            </p>

            <?php 
                Modal::begin([
                    'header' => '<h3>Registrar Frequência</h3>',
                    'id' => 'modalRegistrarFrequencia',
                    'size' => '',
                    //'size' => 'modal-lg',
                    //'size' => 'modal-sm',
                ]);
                echo "<div id='modalRegistrarFrequenciaContent'></div>";
                Modal::end();
            ?>

            <?php 
                Modal::begin([
                    'header' => '<h4>Selecione Mês/Ano</h4>',
                    'id' => 'modalImprimirFrequencias',
                    'size' => '',
                ]);
                echo "<div id='modalImprimirFrequenciasContent'></div>";
                Modal::end();
            ?>
            
            <?= \yii2fullcalendar\yii2fullcalendar::widget(array('events'=> $events,)); ?>
            </div>
        <?php } ?>

    </div>
</div>
</section>