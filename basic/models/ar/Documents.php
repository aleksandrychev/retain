<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property integer $id
 * @property string $title
 * @property integer $uploaded_date
 * @property string $user_ip
 * @property string $user_agent
 * @property string $html_file
 *
 * @property ExtractedDate[] $extractedDates
 * @property ExtractedEntity[] $extractedEntities
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uploaded_date'], 'integer'],
            [['title'], 'string', 'max' => 650],
            [['user_ip'], 'string', 'max' => 20],
            [['user_agent', 'html_file'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'uploaded_date' => 'Uploaded Date',
            'user_ip' => 'User Ip',
            'user_agent' => 'User Agent',
            'html_file' => 'Html File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedDates()
    {
        return $this->hasMany(ExtractedDate::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedEntities()
    {
        return $this->hasMany(ExtractedEntity::className(), ['document_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentsQuery(get_called_class());
    }

    public  function  createDocumentByName($pdfName){


        $this->title = $pdfName;
        $this->user_ip = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->uploaded_date = time();
        $this->save();
        $this->html_file = $this->id . '.html';
        $this->save();
    }
}
