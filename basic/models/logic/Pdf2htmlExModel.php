<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 15:52
 */

namespace app\models\logic;


use yii\base\Model;

class Pdf2htmlExModel extends Model
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;

    }

    public function pdfToHtmlConvertion(){
        exec('pdftohtml '.__DIR__ . '/../web/files/pdf.pdf '.' -xml');
    }

}