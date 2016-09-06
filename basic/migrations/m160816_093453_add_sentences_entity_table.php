<?php

use yii\db\Migration;

class m160816_093453_add_sentences_entity_table extends Migration
{
    public function up()
    {
        $this->createTable('sentence_entities', [
            'result_id' => $this->integer(11),
            'type' => $this->string(20),
            'entity_id' => $this->integer(11),
            'entity_title' => $this->text(),
        ],'ENGINE=InnoDB CHARSET=utf8');

        $this->addForeignKey('fk-sentences_entities', 'sentence_entities', 'result_id', 'sentences', 'id', 'CASCADE');
        $this->createIndex('sentences_entities_result_id_I', 'sentence_entities', 'result_id');
        $this->createIndex('sentences_entities_entity_id_I', 'sentence_entities', 'entity_id');
        $this->createIndex('sentences_entities_unique_I', 'sentence_entities', ['result_id', 'entity_id','type'] , true);

    }

    public function down()
    {
        $this->dropIndex('sentences_entities_result_id_I', 'sentence_entities');
        $this->dropIndex('sentences_entities_entity_id_I', 'sentence_entities');
        $this->dropIndex('sentences_entities_unique_I', 'sentence_entities');
        $this->dropForeignKey('fk-sentences_entities', 'sentence_entities');
        $this->dropTable('sentence_entities');
    }


}
