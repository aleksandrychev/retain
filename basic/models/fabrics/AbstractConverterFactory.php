<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 13:41
 */

namespace app\models\fabrics;

abstract class AbstractConverterFactory
{
    abstract public function convertToHtml();
}