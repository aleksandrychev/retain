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

    public static function getHtmlUrlById($id)
    {
        return Url::base('http') . Url::to('/documents/html/' . $id);
    }

    public static function getSentenceByPhrase($phrase, $text)
    {

        $sentences = explode("\n", $text);

        foreach ($sentences as $k => $v) {
            if (stristr($v, $phrase)) {
                return $v;
            }
        }
    }

    public static function clearHtml($htmlContent)
    {
        $htmlContent = preg_replace("/<img[^>]+\>/i", "", $htmlContent);
        $htmlContent = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $htmlContent);
        $htmlContent = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $htmlContent);
        $htmlContent = preg_replace('/class=".*?"/', '', $htmlContent);
        $htmlContent = preg_replace('/id=".*?"/', '', $htmlContent);
        $htmlContent = preg_replace('/style=".*?"/', '', $htmlContent);

        return $htmlContent;
    }

    public static function getFreeSpace(){
        $bytes = disk_free_space(".");
        $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
        $base = 1024;
        $class = min((int)log($bytes , $base) , count($si_prefix) - 1);

        return  sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    }

}