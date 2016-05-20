<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.05.16
 * Time: 15:03
 */

namespace app\models\helpers;

use app\models\ar\IntellexerClusterize;
use app\models\ar\IntellexerSentences;
use Yii;

class IntellexerSaver
{
    private static $doc_id;

    public static function save($doc_id, $clusters)
    {
        self::$doc_id = $doc_id;
       if(isset($clusters->sentences)){
        self::saveSentences($clusters->sentences);
        } 
        self::clusterizeProcess($clusters);
    }

    private static function clusterizeProcess($clusters)
    {
        if (isset($clusters->conceptTree) && isset($clusters->conceptTree->children)) {
            foreach ($clusters->conceptTree->children as $cluster) {
                $parent_id = self::saveCluster($cluster);
                if (isset($cluster->children) && count($cluster->children) > 0) {
                    foreach ($cluster->children as $c) {
                        self::saveCluster($c, $parent_id);
                    }
                }
            }
        }
    }

    private static function saveCluster($cluster, $pid = 0)
    {

        $ic = new IntellexerClusterize();
        $ic->doc_id = self::$doc_id;
        $ic->parent_id = $pid;
        $ic->sentence_ids = serialize($cluster->sentenceIds);
        $ic->title = $cluster->text;
        $ic->user_id = Yii::$app->user->id;
        $ic->save();

        return $ic->id;
    }


    private static function saveSentences($sentences)
    {
        foreach ($sentences as $k => $s) {
            $is = new IntellexerSentences();
            $is->doc_id = self::$doc_id;
            $is->sentence = strip_tags($s);
            $is->user_id = Yii::$app->user->id;
            $is->internal_id = $k;
            $is->save();
        }
    }


}