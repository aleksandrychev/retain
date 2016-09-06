<?php

use yii\db\Migration;

class m160816_070300_change_sentenses_table extends Migration
{
    public function up()
    {

        $this->renameTable('sentences_plus_hl','sentences');
        $this->dropColumn('sentences','note');
        $this->dropColumn('sentences','manual_date');
        $this->dropColumn('sentences','page_number');
        $this->dropColumn('sentences','line_number');
        $this->dropColumn('sentences','paragraph_number');
        $this->dropColumn('sentences','positions');
        $this->dropColumn('sentences','selection');
        $this->dropColumn('sentences','meta_data');
        $this->dropColumn('sentences','tag_type');
        $this->dropColumn('sentences','send_to_final_report');
        $this->renameColumn('sentences','sent_hl','sentence');

    }

    public function down()
    {
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
