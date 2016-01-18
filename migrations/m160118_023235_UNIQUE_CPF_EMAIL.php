<?php

use yii\db\Migration;

class m160118_023235_UNIQUE_CPF_EMAIL extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE usuario ADD UNIQUE (cpf)");
        $this->execute("ALTER TABLE usuario ADD UNIQUE (email)");
        return true;
    }

    public function down()
    {
        echo "m160118_023235_UNIQUE_CPF_EMAIL cannot be reverted.\n";

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
