<?php

use yii\db\Migration;

class m160426_101122_create_tables_keywords_concepts extends Migration
{
    public function up()
    {
        $this->createTable('extracted_keywords', [
            'id' => $this->primaryKey(),
            'doc_id' => $this->integer(11),
            'relevance' => $this->double(6),
            'text' => $this->string(300),
        ]);

        $this->addForeignKey('fk-keywords-document-id', 'extracted_keywords', 'doc_id', 'documents', 'id', 'CASCADE');
        $this->createIndex('keyword_doc_id_I', 'extracted_keywords', 'doc_id');

        $this->createTable('extracted_concepts', [
            'id' => $this->primaryKey(),
            'doc_id' => $this->integer(11),
            'relevance' => $this->double(6),
            'text' => $this->string(300),
        ]);

        $this->addForeignKey('fk-concepts-document-id', 'extracted_concepts', 'doc_id', 'documents', 'id', 'CASCADE');
        $this->createIndex('concepts_doc_id_I', 'extracted_concepts', 'doc_id');
    }

    public function down()
    {
        $this->dropForeignKey('fk-keywords-document-id', 'extracted_keywords');
        $this->dropForeignKey('fk-concepts-document-id', 'extracted_concepts');

        $this->dropIndex('concepts_doc_id_I', 'extracted_concepts');
        $this->dropIndex('keyword_doc_id_I', 'extracted_keywords');

        $this->dropTable('extracted_keywords');
        $this->dropTable('extracted_concepts');
    }
}
