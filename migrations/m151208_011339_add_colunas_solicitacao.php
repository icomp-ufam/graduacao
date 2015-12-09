<?php

use yii\db\Migration;

class m151208_011339_add_colunas_solicitacao extends Migration
{
    public function up()
    {
        $this->addColumn("solicitacao", "anexoOriginalName", "string");
        $this->addColumn("solicitacao", "anexoHashName", "string");
    }

    public function down()
    {
        return false;
    }
}
