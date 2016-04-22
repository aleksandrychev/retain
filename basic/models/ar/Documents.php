<?php

namespace app\models\ar;

use Yii;

class Documents extends \app\models\ar\base\Documents
{


    public function getEntitiesCount()
    {
        return count($this->extractedEntities);
    }

    public function getDatesCount()
    {
        return count($this->extractedDates);
    }

    public function createDocumentByName($pdfName)
    {
        $this->title = $pdfName;
        $this->user = Yii::$app->user->id;
        $this->user_ip = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->uploaded_date = time();
        $this->save();
        $this->html_file = $this->id . '.html';
        $this->save();
    }
}
