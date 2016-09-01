<?php

use yii\db\Migration;

class m160817_083852_add_view_shl extends Migration
{
    public function up()
    {

        $this->execute(
            "
           CREATE VIEW sentences_plus_hl AS
   SELECT 
tags_result.id,
tags_result.text AS sent_hl,
tags_result.doc_id,
tags_result.id AS tag_id,
tags_result.user_id,
tags_result.note,
tags.title AS entity_type,
'' AS entity,
date AS manual_date,
tags_result.page_number,
tags_result.line_number,
tags_result.paragraph_number,
'tbd' AS meta_data,
'Manual' AS tag_type,
'' AS project_id,
'' AS positions,
'' AS send_to_final_report

FROM tags_result
LEFT JOIN tags ON tags.id = tags_result.tag_id

union

SELECT 
sentences.id + 1000000 as id,
sentences.sentence AS sent_hl,
sentences.doc_id,
'' AS tag_id,
sentences.user_id,
'' AS note,
sentence_entities.type AS entity_type,
sentence_entities.entity_title AS entity,
'' AS manual_date,
'' AS page_number,
'' AS line_number,
'' AS paragraph_number,
'tbd' AS meta_data,
'Auto' AS tag_type,
'' AS project_id,
'' AS positions,
'' AS send_to_final_report
FROM  sentences
RIGHT JOIN sentence_entities ON sentence_entities.result_id = sentences.id
;
            "
        );

    }

    public function down()
    {

        $this->execute('DROP VIEW sentences_plus_hl');
    }
}
