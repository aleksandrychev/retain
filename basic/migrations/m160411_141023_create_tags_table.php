<?php

use yii\db\Migration;

class m160411_141023_create_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'parent_id' => $this->integer(11),
        ]);
    }

    public function down()
    {
        $this->dropTable('tags');
    }
}
