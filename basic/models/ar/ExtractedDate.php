<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "extracted_date".
 *
 * @property integer $id
 * @property string $date
 * @property string $full_sentence
 * @property integer $document_id
 *
 * @property Documents $document
 */
class ExtractedDate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extracted_date';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_sentence'], 'string'],
            [['document_id'], 'integer'],
            [['date'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'full_sentence' => 'Full Sentence',
            'document_id' => 'Document ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }
}
