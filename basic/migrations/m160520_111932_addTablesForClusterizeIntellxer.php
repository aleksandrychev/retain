<?php

use yii\db\Migration;

class m160520_111932_addTablesForClusterizeIntellxer extends Migration
{
    public function up()
    {

        $this->createTable('intellexer_sentences', [
            'id' => $this->primaryKey(),
            'sentence' => $this->string(2000),
            'internal_id' => $this->integer(11),
            'doc_id' => $this->integer(11),
            'user_id' => $this->integer(11),
        ]);

        $this->addForeignKey('fk-intellexer_sentences-doc','intellexer_sentences','doc_id','documents','id','CASCADE');
        $this->addForeignKey('fk-intellexer_sentences-user','intellexer_sentences','user_id','user','id','CASCADE');

        $this->createTable('intellexer_clusterize',[
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'parent_id' => $this->integer(11),
            'sentence_ids' => $this->string(400),
            'doc_id' => $this->integer(11),
            'user_id' => $this->integer(11),
        ]);

        $this->addForeignKey('fk-intellexer_clusterize-doc','intellexer_clusterize','doc_id','documents','id','CASCADE');
        $this->addForeignKey('fk-intellexer_clusterize-user','intellexer_clusterize','user_id','user','id','CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk-intellexer_clusterize-doc','intellexer_clusterize');
        $this->dropForeignKey('fk-intellexer_clusterize-user','intellexer_clusterize');

        $this->dropForeignKey('fk-intellexer_sentences-user','intellexer_sentences');
        $this->dropForeignKey('fk-intellexer_sentences-doc','intellexer_sentences');

        $this->dropTable('intellexer_sentences');
        $this->dropTable('intellexer_clusterize');

    }

}
