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
        $text = str_replace('\n', '. ', $text);
        $sentences = preg_split('/(?<=[\s])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

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

}