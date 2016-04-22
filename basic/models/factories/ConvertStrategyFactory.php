<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 15:42
 */

namespace app\models\factories;


use app\models\convertImplementations\ConvertFromPdf;
use app\models\convertImplementations\ConvertFromDoc;
use app\models\convertImplementations\ConvertFromDocx;


class ConvertStrategyFactory
{
    public static function getImplementation($extension)
    {
        switch ($extension) {
            case 'pdf':
                return new ConvertFromPdf();
                break;
            case 'doc':
                return new ConvertFromDoc();
                break;
            case 'docx':
                return new ConvertFromDocx();
                break;
            default:
                throw new \Exception('File with this extension dose not have convert implementation');
                break;
        }
    }
}