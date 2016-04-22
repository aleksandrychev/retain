<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 14:11
 */

namespace app\models\logic;


use app\helpers\AppHelper;

class ConverterManager
{
    protected $implementation;

    public function __construct($implementation)
    {
            $this->implementation = $implementation;
    }

    public function __call($name, $arguments)
    {
        $this->implementation->$name($arguments);
        return $this;
    }

    public function convertToHtml()
    {
        $this->implementation->convertToHtml();
        return $this;
    }

    public function htmlSaveWithoutTags()
    {
        $uploadsDir = __DIR__ . '/../../web/uploads';
        $text = file_get_contents($uploadsDir . '/html/' .$this->implementation->docID . '.html');
        $text = AppHelper::clearHtml($text);
        file_put_contents($uploadsDir . '/strip_html/' .  $this->implementation->docID . '.html' , $text);
    }

    public function setDocId($id)
    {
        $this->implementation->setDocId($id);
        return $this;
    }

}