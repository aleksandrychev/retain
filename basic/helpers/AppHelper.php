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

    private static $tempSent = [];

    public static function getHtmlUrlById($id)
    {
        return Url::base('http') . Url::to('/documents/html/' . $id);
    }

    public static function getSentenceByPhrase($phrase, $htmlFileName)
    {
        $text = file_get_contents(__DIR__ . '/../web/uploads/html/' . $htmlFileName);
        $text = strip_tags(AppHelper::clearHtml($text));
        $re = '/(?<=[.!?”]|[.!?][\'"])\s+(?=[A-Z"\'])/';
        $sentences = preg_split($re, $text, -1, PREG_SPLIT_NO_EMPTY);

        if (array_key_exists($phrase, self::$tempSent)) {
         $res =   self::findInArray(self::$tempSent[$phrase], $phrase, false);
        } else {
            $res =    self::findInArray($sentences, $phrase, true);
        }

        return  $res;

    }

    public static function findInArray($sentences, $phrase, $merge)
    {
        $tms = $sentences;
        foreach ($sentences as $k => $v) {
            if (stristr($v, $phrase)) {
                unset($tms[$k]);
                if ($merge) {
                    self::$tempSent = array_merge(self::$tempSent, ["$phrase" => $tms]);
                } else {
                    self::$tempSent[$phrase] = $tms;
                }
                return $v;
            }
        }
    }

    public static function clearHtml($htmlContent)
    {
        $replacePatterns = [
            "/<img[^>]+\>/i",
            '#<script(.*?)>(.*?)</script>#is',
            '#<style(.*?)>(.*?)</style>#is',
            '/class=".*?"/',
            '/id=".*?"/',
            '/style=".*?"/',
            '/&.*?;/',
            '/\n/'
        ];

        foreach ($replacePatterns as $pattern) {
            $htmlContent = preg_replace($pattern, '', $htmlContent);
        }

        return $htmlContent;
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