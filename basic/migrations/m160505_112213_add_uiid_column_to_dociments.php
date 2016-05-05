<?php

use yii\db\Migration;

class m160505_112213_add_uiid_column_to_dociments extends Migration
{
    public function up()
    {
        $this->addColumn('documents','uuid','varchar(50)');
        $this->addColumn('sentences_plus_hl','send_to_final_report','varchar(50)');
    }

    public function down()
    {
        $this->dropColumn('documents','uuid');
        $this->dropColumn('sentences_plus_hl','send_to_final_report');
    }
}
