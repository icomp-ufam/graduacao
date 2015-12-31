<?php
/* @var $this yii\web\View */
//use gietos\yii\ionicons\Ion;
use scotthuangzl\googlechart\GoogleChart;
?>

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<div class="row">

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-success">
            <div class="inner">
                <p><i class="fa icon-tasks icon-4x pull-right"></i></p>
                <h3>99<?php $solicitacoesEmAberto ?></h3>
                <h4>Aguardando a Secretaria</h4>
            </div>

            <a href="#" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-info">
            <div class="inner">
                <p><i class="fa icon-thumbs-up icon-4x pull-right"></i></p>
                <h3>99<?php $horasEmPesquisa ?></h3>
                <h4>Solicitações Arquivadas</h4>
            </div>

            <a href="#" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-danger">
            <div class="inner">
                <p><i class="fa icon-warning-sign icon-4x pull-right"></i></p>
                <h3>20<?php $horasEmExtensao ?></h3>
                <h4>Solicitações em aberto</h4>
            </div>

            <a href="#" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h3>Gráficos: </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                    array('Grupo', 'Horas'),
                    array('Ensino', 60),
                    array('Pesquisa', 40),
                    array('Extensão', 20)
                ),
            'options' => array('title' => 'Distribuição por Grupo')));
        ?>
    </div>

    <div class="col-md-6">
        <?php
        echo GoogleChart::widget(array('visualization' => 'LineChart',
            'data' => array(
                array('Mês', 'Ensino', 'Pesquisa', 'Extensão'),
                array('Janeiro',    5, 10, 1),
                array('Fevereiro',  5, 5, 4),
                array('Março',      15, 5, 5),
                array('Abril',      10, 20, 2),
                array('Junho',      15, 20, 10),
                array('Julho',      10, 20, 5),
            ),
            'options' => array(
                'title' => 'Horas x Meses x Grupos',
                'titleTextStyle' => array('color' => '#FF0000'),
                'vAxis' => array(
                    'title' => 'Horas',
                    'gridlines' => array(
                        'color' => 'transparent'  //set grid line transparent
                    )),
                'hAxis' => array('title' => 'Meses'),
                'curveType' => 'function', //smooth curve or not
                'legend' => array('position' => 'bottom'),
            )));
        ?>
    </div>
</div>