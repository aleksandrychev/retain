<?php

namespace app\models\ar;

use Yii;
use yii\helpers\Url;

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

    public function getProjectName()
    {
          if($this->project)  return $this->project->title;
    }

    public function getUrlToView(){
      return  Url::base('http') . Url::to('/uploads/html/' . $this->html_file);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntellexerSentences()
    {
        return $this->hasMany(\app\models\ar\IntellexerSentences::className(), ['doc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntellexerClusters()
    {
        return $this->hasMany(\app\models\ar\IntellexerClusterize::className(), ['doc_id' => 'id']);
    }




    public function afterSave($insert, $changedAttributes)
    {
        $db = \Yii::$app->db;
        $db->createCommand('UPDATE documents SET uuid = UUID() WHERE id = ' . $this->id)->query();

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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
