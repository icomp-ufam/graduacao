<?php

use yii\db\Migration;

class m151207_195653_add_collumn_arquivo extends Migration
{

    public function up()
    {
        $this->addColumn("solicitacao", "arquivo", "string");
    }

    public function down()
    {
        return false;
    }

}

