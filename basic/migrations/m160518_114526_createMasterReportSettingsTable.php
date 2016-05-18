<?php

use yii\db\Migration;

class m160518_114526_createMasterReportSettingsTable extends Migration
{
    public function up()
    {
        $this->createTable('master_report_settings', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'serialized_columns' => $this->string(2000),
        ]);

        $this->createIndex('user_id_mrs_I', 'master_report_settings', 'user_id', true);
        $this->addForeignKey('user_id_mrs_FK','master_report_settings','user_id','user','id','CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('user_id_mrs_FK','master_report_settings');
        $this->dropIndex('user_id_mrs_I', 'master_report_settings');
        $this->dropTable('master_report_settings');
    }

}
