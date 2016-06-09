<?php

use yii\db\Migration;

class m160531_121527_addFieldToProject extends Migration
{
    public function up()
    {
        $this->addColumn('projects','text','text');
    }

    public function down()
    {
        $this->dropColumn('projects','text');
    }


}
