<?php

use yii\db\Migration;

class m160111_020838_Add_Coluna_DATACRIACAO_SOLI extends Migration
{
    public function up()
    {
        $this->addColumn("solicitacao", "created_at", "date");
    }

    public function down()
    {
        echo "m160111_020838_Add_Coluna_DATACRIACAO_SOLI cannot be reverted.\n";

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
