<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "extracted_entity".
 *
 * @property integer $id
 * @property string $type
 * @property string $entity
 * @property string $full_sentence
 * @property integer $document_id
 *
 * @property Documents $document
 */
class ExtractedEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extracted_entity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_sentence'], 'string'],
            [['document_id'], 'integer'],
            [['type'], 'string', 'max' => 50],
            [['entity'], 'string', 'max' => 350]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'entity' => 'Entity',
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

    /**
     * @inheritdoc
     * @return ExtractedEntityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExtractedEntityQuery(get_called_class());
    }
}
