<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitacao */

$this->title = 'Relatório';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="?r=solicitacao/index"><i class="fa fa-download"></i> Solicitações</a></li>
        <li class="active"><a href="?r=solicitacao/view">Visualizar</a></li>
    </ol>
</section>

<section class="content">

    <div class="box box-success">
        <div class="box-header">
            <h4>Click em cima da matricula para copiar para a àrea de transferencia...</h4>
        </div>
        <div class="solicitacao-view box-body">

            <table class="table table-hover table-bordered">
                <thead>
                    <th>Aluno</th>
                    <th>Matricula</th>
                    <th>Grupo</th>
                    <th>Horas</th>
                </thead>

                <?php foreach($resultado as $res) {?>
                <tr>
                    <td><?= $res['nome'] ?></td>
                    <td onclick="copyToClipboard(this)"><?= $res['matricula'] ?></td>

                    <td>
                        <?php foreach($res['grupo'] as $grupo) {?>
                            <tr>
                                <td></td><td></td>
                                <td><?= $grupo['descricao'] ?></td><td><?= $grupo['soma'] ?></td>
                            </tr>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</section>

<!-- Script para Copiar para a area de transf. -->
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");

        $temp.remove();

    }
</script>