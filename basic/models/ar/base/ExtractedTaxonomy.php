<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "extracted_taxonomy".
 *
 * @property integer $id
 * @property integer $doc_id
 * @property double $relevance
 * @property string $text
 *
 * @property Documents $doc
 */
class ExtractedTaxonomy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extracted_taxonomy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id'], 'integer'],
            [['relevance'], 'number'],
            [['text'], 'string', 'max' => 300],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['doc_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_id' => 'Doc ID',
            'relevance' => 'Relevance',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Documents::className(), ['id' => 'doc_id']);
    }
}
