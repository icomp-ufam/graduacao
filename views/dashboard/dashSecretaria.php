<?php
/* @var $this yii\web\View */
//use gietos\yii\ionicons\Ion;
use scotthuangzl\googlechart\GoogleChart;
?>

<section class="content">
<div class="row">

    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-success">
            <div class="inner">
                <p><i class="fa fa-tasks fa-4x pull-right"></i></p>
                <h3>99<?php $solicitacoesEmAberto ?></h3>
                <h4>Solicitações Aguardando Avaliação</h4>
            </div>

            <a href="?r=solicitacao%2Findex&SolicitacaoSearch%5Bstatus%5D=Submetida" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-danger">
            <div class="inner">
                <p><i class="fa fa-exclamation-triangle fa-4x pull-right"></i></p>
                <h3>20<?php $horasEmExtensao ?></h3>
                <h4>Solicitações Indeferidas</h4>
            </div>

			<a href="?r=solicitacao%2Findex&SolicitacaoSearch%5Bstatus%5D=Indeferida" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    
    <div class="col-sm-4 col-md-4">
        <div class="thumbnail alert alert-info">
            <div class="inner">
                <p><i class="fa fa-thumbs-up fa-4x pull-right"></i></p>
                <h3>99<?php $horasEmPesquisa ?></h3>
                <h4>Solicitações Deferidas</h4>
            </div>

            <a href="?r=solicitacao%2Findex&SolicitacaoSearch%5Bstatus%5D=Deferida" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>



</div>

</section>
