<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 15.03.16
 * Time: 11:34
 */

namespace app\helpers;


class AppHelper
{

    public static function getHtmlUrlByHtmlName($htmlName){
        //                $url =  Url::base('http') .  Url::to('/uploads/html/' . $htmlName);
        $url = "http://pdf2html.demo.relevant.software/uploads/html/4.html";
        return $url;
    }

    public static function  getSentenceByPhrase($phrase,$text){
           $text = str_replace('\n','. ',$text);
           $sentences = preg_split('/(?<=[\s])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        foreach($sentences as $k=>$v){
            if(stristr($v,$phrase)){
                return $v;
            }
        }
    }

}