<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 02.03.16
 * Time: 16:21
 */

namespace app\models;

use Gufy\PdfToHtml\Pdf;


class PdfToHtml
{
    private $fontSpecs = [];

    public function readPdf()
    {

        $xml = simplexml_load_file(__DIR__ . "/../web/files/pdf.xml");

        $return = '';
        $i = 1;
        foreach ($xml->page as $page) {
           $i++;
            $this->setFontSpecs($page->fontspec);
            $return .= '<div style="height: 1200px;position: relative">';
            foreach ($page->children() as $key => $element) {

                switch($key){
                    case 'text':
                        $return .= '<p style="' . $this->getStyle($element->attributes()) . '"">' . $element->asXML() . '</p>';
                        break;
                    case 'image':
                        $return .= '<img '. $this->getImageAttr($element->attributes()) .' />';
                        break;
                }


            }
            $return .= '<hr></div>';

if($i > 10) return $return ;
        }
        return $return ;
    }

    public function getStyle($attributes)
    {
        $style = 'position: absolute;';
        foreach ($attributes as $key => $attr) {
            if ($key == 'font') {

                $style .= $this->fontSpecs[intval($attr)];
            }
            $style .= $key . ': ' . $attr . 'px;';

        }

        return $style;
    }

    public function getImageAttr($attributes)
    {
        $style = 'style=" position: absolute;';
        $src = '';
        foreach ($attributes as $key => $attr) {
        switch($key){
            case 'src':
                $arrUrl = explode('/',strval($attr));

                if(is_array($arrUrl)){
                   $url = end($arrUrl) ;
                }

                $src = ' src="/files/'. $url .'" ';
                break;
            default:
                $style .= $key . ': ' . $attr . 'px;';
                break;
        }
        }
        $style .= '"';

        return $style . ' ' .$src;
    }


    public function setFontSpecs($fontSpecs)
    {
        foreach ($fontSpecs as $fs) {
            $style = '';

            foreach ($fs->attributes() as $key => $attr) {
                switch ($key) {
                    case 'id':
                        $id = intval($attr);
                        break;
                    case 'size':
                        $style .= 'font-size:' . $attr . 'px;';
                        break;
                    case 'family':
                        $style .= 'font-family:' . $attr . ';';
                        break;
                    case 'color':
                        $style .= 'color:' . $attr . ';';
                        break;
                }
            }
            $this->fontSpecs[$id] = $style;
        }
    }

}