<?php

use yii\db\Migration;

class m160314_124607_initial_migration extends Migration
{
    public function up()
    {

        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'position' => $this->integer(4)->defaultValue(0),
            'user' => $this->integer(11),
        ]);
        $this->createIndex('title-pr-I', 'projects', 'title(3)');
        $this->addForeignKey('fk-user-project', 'projects', 'user', 'user', 'id', 'CASCADE');

        $this->createTable('documents', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(11),
            'user' => $this->integer(11),
            'title' => $this->string(650),
            'uploaded_date' => $this->integer(11),
            'user_ip' => $this->string(20),
            'user_agent' => $this->string(400),
            'html_file' => $this->string(100),
        ]);
        $this->createIndex('title', 'documents', 'title(3)');
        $this->addForeignKey('fk-user-document', 'documents', 'user', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-project-document', 'documents', 'project_id', 'projects', 'id', 'CASCADE');

        $this->createTable('extracted_entity', [
            'id' => $this->primaryKey(),
            'type' => $this->string(50),
            'entity' => $this->string(350),
            'full_sentence' => $this->text(),
            'document_id' => $this->integer(11),
        ]);

        $this->createIndex('extracted_entity_I', 'extracted_entity', 'document_id');
        $this->createIndex('type_I', 'extracted_entity', 'type');
        $this->createIndex('entity_I', 'extracted_entity', 'entity(3)');
        $this->addForeignKey('fk-document-id', 'extracted_entity', 'document_id', 'documents', 'id', 'CASCADE');

        $this->createTable('extracted_date', [
            'id' => $this->primaryKey(),
            'date' => $this->string(250),
            'full_sentence' => $this->text(),
            'document_id' => $this->integer(11),
        ]);

        $this->createIndex('extracted_date_I', 'extracted_date', 'document_id');
        $this->createIndex('date_I', 'extracted_date', 'date');
        $this->addForeignKey('fk-document-id-ed', 'extracted_date', 'document_id', 'documents', 'id', 'CASCADE');

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
        $this->dropForeignKey('fk-project-document', 'documents');
        $this->dropForeignKey('fk-user-project', 'projects');
        $this->dropForeignKey('fk-document-id', 'extracted_entity');
        $this->dropForeignKey('fk-document-id-ed', 'extracted_date');
        $this->dropForeignKey('fk-user-document', 'documents');


        $this->dropIndex('date_I', 'extracted_date');
        $this->dropIndex('extracted_date_I', 'extracted_date');
        $this->dropIndex('type_I', 'extracted_entity');
        $this->dropIndex('extracted_entity_I', 'extracted_entity');
        $this->dropIndex('entity_I', 'extracted_entity');


        $this->dropTable('documents');
        $this->dropTable('extracted_entity');
        $this->dropTable('extracted_date');

        $this->dropForeignKey('fk-user-tag', 'tags');
        $this->dropTable('tags');
    }


}
