<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 13:41
 */

namespace app\models\base;


abstract class AbstractConverterBase
{
    public $docID;

    /**
     * Converting Document to Html
     * you must to save converted file into /web/uploads/html
     * with name %document_id%.html
     *
     * @return void
     */
    abstract public function convertToHtml();

    public function setDocId($id){
        $this->docID = $id;
    }

}