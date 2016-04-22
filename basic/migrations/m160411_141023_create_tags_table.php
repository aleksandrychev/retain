<?php

use yii\db\Migration;

class m160411_141023_create_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'user' => $this->integer(11),
            'title' => $this->string(200),
            'parent_id' => $this->integer(11),
        ]);
        $this->addForeignKey('fk-user-tag', 'tags', 'user', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-user-tag', 'tags');
        $this->dropTable('tags');
    }
}
