<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alterar a Senha';

?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>


    Olá  <?= Html::encode($usuario) ?>, <br/>
    
    Você solicitou a alteração da senha no Sistema de Atividades Complementares do ICOMP. <br/>
    
    Clique no link abaixo para trocar a senha. <br/>
    
    
    <a href="<?= $url ?>"> [ Link ]</a>
    
    <div class='foot'>
        <p>
            <small>
                Copyright © 2015 Instituto de Computação - Universidade Federal do Amazonas. <br/>
                Todos os direitos reservados. <br/>
                Designed by Icomp. v1.0 <br/>
            </small>
        </p>
    </div>

</div>