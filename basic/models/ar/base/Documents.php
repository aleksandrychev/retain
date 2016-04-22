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
            [['user', 'uploaded_date'], 'integer'],
            [['title'], 'string', 'max' => 650],
            [['user_ip'], 'string', 'max' => 20],
            [['user_agent'], 'string', 'max' => 400],
            [['html_file'], 'string', 'max' => 100],
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
            'user' => 'User',
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
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getTagsResults()
    {
        return $this->hasMany(TagsResult::className(), ['doc_id' => 'id']);
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
