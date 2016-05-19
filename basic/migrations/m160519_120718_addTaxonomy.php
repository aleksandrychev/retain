<?php

use yii\db\Migration;

class m160519_120718_addTaxonomy extends Migration
{
    public function up()
    {

        $this->createTable('extracted_taxonomy', [
            'id' => $this->primaryKey(),
            'doc_id' => $this->integer(11),
            'relevance' => $this->double(6),
            'text' => $this->string(300),
        ]);

        $this->addForeignKey('fk-taxonomy-document-id', 'extracted_taxonomy', 'doc_id', 'documents', 'id', 'CASCADE');
        $this->createIndex('taxonomy_doc_id_I', 'extracted_taxonomy', 'doc_id');
    }

    public function down()
    {
        $this->dropForeignKey('fk-taxonomy-document-id', 'extracted_taxonomy');
        $this->dropIndex('taxonomy_doc_id_I', 'extracted_taxonomy');
        $this->dropTable('extracted_taxonomy');
    }

}
