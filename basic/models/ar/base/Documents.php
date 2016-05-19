<?php

namespace app\models\ar\base;


use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property integer $id
 * @property integer $user
 * @property string $title
 * @property integer $uploaded_date
 * @property string $user_ip
 * @property string $user_agent
 * @property string $html_file
 * @property string $project_id
 * @property string $uuid
 *
 * @property User $user0
 * @property ExtractedDate[] $extractedDates
 * @property ExtractedEntity[] $extractedEntities
 * @property TagsResult[] $tagsResults
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
            [['user', 'uploaded_date', 'project_id'], 'integer'],
            [['title'], 'string', 'max' => 650],
            [['projectName'], 'safe'],
            [['user_ip'], 'string', 'max' => 20],
            [['user_agent'], 'string', 'max' => 400],
            [['html_file', 'uuid'], 'string', 'max' => 100],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'user' => 'User',
            'title' => 'Title',
            'uploaded_date' => 'Uploaded Date',
            'user_ip' => 'User Ip',
            'user_agent' => 'User Agent',
            'html_file' => 'Html File',
            'projectName' => 'Project',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    public function getProject()
    {
        return $this->hasOne(\app\models\ar\Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedDates()
    {
        return $this->hasMany(\app\models\ar\ExtractedDate::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedEntities()
    {
        return $this->hasMany(\app\models\ar\ExtractedEntity::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedKeywords()
    {
        return $this->hasMany(\app\models\ar\ExtractedKeywords::className(), ['doc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedTaxonomy()
    {
        return $this->hasMany(\app\models\ar\ExtractedTaxonomy::className(), ['doc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtractedConcepts()
    {
        return $this->hasMany(\app\models\ar\ExtractedConcepts::className(), ['doc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsResults()
    {
        return $this->hasMany(\app\models\ar\TagsResult::className(), ['doc_id' => 'id']);
    }



    /**
     * @inheritdoc
     * @return DocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentsQuery(get_called_class());
    }


}
