<?php

use yii\db\Migration;

class m160816_094406_delete_columns extends Migration
{
    public function up()
    {

        $this->dropForeignKey('fk-shl-project_id', 'sentences');
        $this->dropForeignKey('fk-shl-tag-id', 'sentences');

        $this->dropColumn('sentences','entity');
        $this->dropColumn('sentences','entity_type');
        $this->dropColumn('sentences','tag_id');
        $this->dropColumn('sentences','project_id');

    }

    public function down()
    {
      return true;
    }

}
