<?php
/* @var $this yii\web\View */
//use gietos\yii\ionicons\Ion;
use scotthuangzl\googlechart\GoogleChart;
use miloschuman\highcharts\Highcharts;

?>

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<div class="row">

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-success">
            <div class="inner">
                <p><i class="fa fa-graduation-cap icon-4x pull-right"></i></p>
                <h3><?php echo $horasEmEnsino ?> Horas</h3>
                <h4>Ensino</h4>
            </div>

            <a href="?r=solicitacao/index" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-warning">
            <div class="inner">
                <p><i class="fa fa-object-ungroup icon-4x pull-right"></i></p>
                <h3><?php echo $horasEmPesquisa ?> Horas</h3>
                <h4>Pesquisa</h4>
            </div>

            <a href="?r=solicitacao/index" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-info">
            <div class="inner">
                <p><i class="fa fa-paper-plane icon-4x pull-right"></i></p>
                <h3><?php echo $horasEmExtensao ?> Horas</h3>
                <h4>Extensão</h4>
            </div>

            <a href="?r=solicitacao/index" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h3>Gráfico: </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    
    </div>

    <div class="col-md-6">
        <?php

            echo Highcharts::widget([
                'options' => [               
                    'title' => ['text' => 'Distribuição por Grupos'],
               
                    'series' => [[
                        'type' => 'pie',
                        'name' => 'Grupos',
                        'data' => [
                            ['name' => 'Ensino', 'y' => (float) $horasEmEnsino ],
                            ['name' => 'Pesquisa', 'y' => (float) $horasEmPesquisa],
                            ['name' => 'Extensão', 'y' => (float) $horasEmExtensao]                            
                        ]
                    ]]               
                ]
            ]);
        ?>
    </div>  

</div>