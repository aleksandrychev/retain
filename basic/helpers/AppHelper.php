<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 15.03.16
 * Time: 11:34
 */

namespace app\helpers;


use yii\helpers\Url;


class AppHelper
{

    public static $tempSent = [];

    public static function getHtmlUrlById($id)
    {
        return Url::base('http') . Url::to('/documents/html/' . $id);
    }

    public static function getSentenceByPhrase($phrase, $htmlFileName, $d = false)
    {
        ini_set('memory_limit', '2048M');
        ini_set('pcre.backtrack_limit', '200M');

        $phrase = self::clearHtml($phrase);

        $sentences = file_get_contents(__DIR__ . '/../web/uploads/json/' . $htmlFileName);
        $sentences = str_replace(array('["','"]'),'',$sentences);
        $sentences = explode('", "',$sentences);


        if (array_key_exists($phrase, self::$tempSent)) {
            $res = self::findInArray(self::$tempSent[$phrase], $phrase, false,$d);
        } else {
            $res = self::findInArray($sentences, $phrase, true ,$d);
        }

        return $res;

    }

    public static function findInArray($sentences, $phrase, $merge, $d)
    {
        $tms = $sentences;
        foreach ($sentences as $k => $v) {
            if (stristr($v, $phrase)) {
                unset($tms[$k]);
                if ($merge) {
                    self::$tempSent = array_replace(self::$tempSent, ["$phrase" => $tms]);
                } else {
                    self::$tempSent[$phrase] = $tms;
                }
                return $v;
            }
        }
    }

    public static function clearHtml($htmlContent)
    {
        ini_set('pcre.backtrack_limit', '200M');
        $replacePatterns = [
            '#\.<.*?>#is' => '. ',
            '#<\/div>#is' => ' ',
            '#<\/p>#is' => ' ',
            '#\;<.*?>#is' => '; ',
            "/<img[^>]+\>/i" => '',
            '#<script(.*?)>(.*?)</script>#is' => '',
            '#<style(.*?)>(.*?)</style>#is' => '',
            '/class=".*?"/' => '',
            '/id=".*?"/' => '',
            '/style=".*?"/' => '',
            '/&.*?;/' => '',
            '/\n/' => ''
        ];

        foreach ($replacePatterns as $pattern => $replacement) {
            $htmlContent = preg_replace($pattern, $replacement, $htmlContent);
        }

        $htmlContent = str_replace('  ',' ',$htmlContent);
        return strip_tags($htmlContent);
    }

    public static function convertModelToArray($models) {
        if (is_array($models))
            $arrayMode = TRUE;
        else {
            $models = array($models);
            $arrayMode = FALSE;
        }

        $result = array();
        foreach ($models as $model) {
            $attributes = $model->getAttributes();
            $relations = array();
            foreach ($model->populatedRelations as $key => $related) {
                if ($model->hasRelated($key)) {
                    $relations[$key] = self::convertModelToArray($model->$key);
                }
            }
            $all = array_merge($attributes, $relations);

            if ($arrayMode)
                array_push($result, $all);
            else
                $result = $all;
        }
        return $result;
    }

    public static function getFreeSpace()
    {
        $bytes = disk_free_space(".");
        $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
        $base = 1024;
        $class = min((int)log($bytes, $base), count($si_prefix) - 1);

        return sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
    }

  }