<?php

use yii\db\Migration;

/**
 * Handles adding color to table `notes`.
 */
class m160815_142650_add_color_to_notes extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tags_result','color','VARCHAR(10)');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tags_result','color');
    }
}
