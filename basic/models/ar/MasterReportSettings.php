<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 18.05.16
 * Time: 15:25
 */

namespace app\models\ar;


class MasterReportSettings extends \app\models\ar\base\MasterReportSettings
{

    public static function getLabels()
    {
        return [
            'user_id' => 'User ID',
            'projectName' => 'Project Name',
            'docName' => 'Source Document',
            'note:ntext' => 'Note',
            'sent_hl:ntext' => 'Highlight + Sentence',
            'meta_data' => 'Meta Data',
            'reference' => 'Reference',
            'tag_type' => 'Tag Type',
            'entity_type' => 'Entity 1 Type',
            'entity' => 'Entity 1',
            'keywordString' => 'Documents Keywords	',
            'conceptString' => 'Documents Concepts',
            'send_to_final_report' => 'Send to final report',
        ];
    }

    public static function getSettings()
    {
        $settings = self::findOne(['user_id' => \Yii::$app->user->id]);
        if ($settings) {
            return unserialize($settings->serialized_columns);
        } else {
            return false;
        }
    }

    public static function setSettings()
    {

        $mss = self::findOne(['user_id' => \Yii::$app->user->id]);
        if (!$mss) {
            $mss = new MasterReportSettings();
            $mss->user_id = \Yii::$app->user->id;
            $mss->serialized_columns = serialize(array_flip($_POST['columns']));
        } else {
            $mss->serialized_columns = serialize(array_flip($_POST['columns']));
        }
        $mss->save();

    }

    public static function clearColumns($columns)
    {

        $tmp = [];
        $settings = self::getSettings();

        foreach ($settings as $key => $v) {
            if (isset($columns[$key])) {
                $tmp[$key] = $columns[$key];
            } elseif(in_array($key, $columns)){
                $tmp[$key] = $columns[array_search($key, $columns)];
            }
        }

        if (count($tmp) == 0) {
            return $columns;
        }

        return $tmp;

    }

}