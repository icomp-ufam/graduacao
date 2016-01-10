<?php

use yii\db\Migration;

class m160110_192210_Coluna_Curso_Grupo extends Migration
{
    public function up()
    {
        $this->addColumn("grupo", "curso_id", "integer");
    }

    public function down()
    {
        echo "m160110_192210_Coluna_Curso_Grupo cannot be reverted.\n";

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
