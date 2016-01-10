<?php

use yii\db\Migration;

class m160110_171631_Coluna_Ativo_Periodo extends Migration
{
    public function up()
    {
        $this->addColumn("periodo", "isAtivo", "boolean");
    }

    public function down()
    {
        echo "m160110_171631_Coluna_Ativo_Periodo cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
