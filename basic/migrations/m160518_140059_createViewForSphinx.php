<?php

use yii\db\Migration;

class m160518_140059_createViewForSphinx extends Migration
{
    public function up()
    {

        $this->execute(
            '
           CREATE VIEW sh_search AS
           SELECT hls.id AS ids,
           hls.note,
           hls.user_id,
           hls.entity_type,
           hls.entity,
           hls.manual_date,
           hls.sent_hl,
           hls.selection,
           hls.meta_data,
           hls.tag_type,
           documents.title AS document_title,
           projects.title AS project_title,
           GROUP_CONCAT(extracted_keywords.text, " ") AS keywords,
            GROUP_CONCAT(extracted_concepts.text, " ") AS concepts
            FROM `sentences_plus_hl` AS hls
            LEFT JOIN documents ON documents.id = hls.`doc_id`
            LEFT JOIN projects ON projects.id = documents.`project_id`
            LEFT JOIN extracted_keywords ON extracted_keywords.doc_id= hls.`doc_id`
            LEFT JOIN extracted_concepts ON extracted_concepts.doc_id= hls.`doc_id`
            GROUP BY hls.id
            '
        );

    }

    public function down()
    {

        $this->execute('DROP VIEW sh_search');
    }


}
