<?php

use yii\db\Migration;

class m160428_114456_create_sentences_plus_highlights_table extends Migration
{
    public function up()
    {
        $this->createTable('sentences_plus_hl', [
            'id' => $this->primaryKey(),
            'doc_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
            'user_id'  => $this->integer(11),
            'project_id' => $this->integer(11),
            'note' => $this->text(),
            'entity_type' => $this->string(200),
            'entity' => $this->string(400),
            'manual_date' => $this->string(50),
            'page_number' => $this->integer(7),
            'line_number' => $this->integer(7),
            'paragraph_number' => $this->integer(7),
            'positions' => $this->string(200),
            'sent_hl' => $this->text(),
            'meta_data' =>  $this->string(50),
            'tag_type' =>  $this->boolean()->defaultValue(false),

        ]);
        $this->addForeignKey('fk-shl-document-id', 'sentences_plus_hl', 'doc_id', 'documents', 'id', 'CASCADE');
        $this->addForeignKey('fk-shl-tag-id', 'sentences_plus_hl', 'tag_id', 'tags', 'id', 'CASCADE');
        $this->addForeignKey('fk-shl-user_id', 'sentences_plus_hl', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-shl-project_id', 'sentences_plus_hl', 'project_id', 'projects', 'id', 'CASCADE');

        $this->createIndex('sentences_plus_hl_doc_id_I', 'sentences_plus_hl', 'doc_id');
        $this->createIndex('sentences_plus_hl_user_id_I', 'sentences_plus_hl', 'user_id');
        $this->createIndex('sentences_plus_hl_project_id_I', 'sentences_plus_hl', 'project_id');

    }

    public function down()
    {

        $this->dropForeignKey('fk-shl-document-id', 'sentences_plus_hl');
        $this->dropForeignKey('fk-shl-tag-id', 'sentences_plus_hl');
        $this->dropForeignKey('fk-shl-user_id', 'sentences_plus_hl');
        $this->dropForeignKey('fk-shl-project_id', 'sentences_plus_hl');

        $this->dropIndex('sentences_plus_hl_doc_id_I', 'sentences_plus_hl');
        $this->dropIndex('sentences_plus_hl_user_id_I', 'sentences_plus_hl');
        $this->dropIndex('sentences_plus_hl_project_id_I', 'sentences_plus_hl');

        $this->dropTable('sentences_plus_hl');
    }
}
