<?php

use yii\db\Migration;

class m160413_092901_create_tag_result_tables extends Migration
{
    public function up()
    {
        $this->createTable('tags_result', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'note' => $this->text(),
            'doc_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
            'page_number' => $this->integer(7),
            'positions' => $this->string(200),
        ]);
        $this->addForeignKey('fk-tags-document-id', 'tags_result', 'doc_id', 'documents', 'id', 'CASCADE');
        $this->addForeignKey('fk-tags-id', 'tags_result', 'tag_id', 'tags', 'id', 'CASCADE');
        $this->createIndex('tags_result_doc_id_I', 'tags_result', 'doc_id');

        $this->createTable('tag_entities', [
            'result_id' => $this->integer(11),
            'type' => $this->string(20),
            'entity_id' => $this->integer(11),
        ]);
        $this->addForeignKey('fk-tag_entities', 'tag_entities', 'result_id', 'tags_result', 'id', 'CASCADE');
        $this->createIndex('tag_entities_result_id_I', 'tag_entities', 'result_id');
        $this->createIndex('tag_entities_entity_id_I', 'tag_entities', 'entity_id');
        $this->createIndex('tag_entities_unique_I', 'tag_entities', ['result_id', 'entity_id','type'] , true);

    }

    public function down()
    {
        $this->dropForeignKey('fk-tag_entities', 'tag_entities');
        $this->dropForeignKey('fk-tags-document-id', 'tags_result');
        $this->dropForeignKey('fk-tags-id', 'tags_result');

        $this->dropIndex('tag_entities_result_id_I', 'tag_entities');
        $this->dropIndex('tag_entities_entity_id_I', 'tag_entities');
        $this->dropIndex('tag_entities_unique_I', 'tag_entities');
        $this->dropIndex('tags_result_doc_id_I', 'tags_result');

        $this->dropTable('tags_result');
        $this->dropTable('tag_entities');




    }
}
