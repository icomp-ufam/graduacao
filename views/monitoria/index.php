<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MonitoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitorias';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
</section>
<section class="content">
<div class="box box-success">
    <div class="monitoria-index box-body">

    <?php if(isset($erro) && $erro == 1) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Você não está cadastrado como monitor."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <?php if(isset($erro) && $erro == 2) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "O último período cadastrado não possui registros de monitoria."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <?php if(isset($erro) && $erro == 3) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Não existe período ativo no sistema. Informe a secretaria sobre este erro."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <?php if(isset($erro) && $erro == 4) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "A inscrição para monitoria não está aberta."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    <?php if(isset($erro) && $erro == 5) { ?>
        <p id="alerta" class='col-xs-12 alert alert-danger'><?php echo "<strong>Atenção!</strong><br>"; echo "Acesso negado. Você não pode acessar monitorias de outros usuários."; ?></p>
        <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 10000);
        </script>
    <?php } ?>

    </div>
</div>
</section>