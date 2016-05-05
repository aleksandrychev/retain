<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "sentences_plus_hl".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $note
 * @property string $manual_date
 * @property integer $page_number
 * @property integer $line_number
 * @property integer $paragraph_number
 * @property string $positions
 * @property string $sent_hl
 * @property string $meta_data
 * @property string $entity_type
 * @property string $entity
 *
 * @property ExtractedDate $date
 * @property Documents $doc
 * @property Projects $project
 * @property Tags $tag
 * @property User $user
 * @property integer $tag_type
 */
class SentencesPlusHl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sentences_plus_hl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'doc_id',
                    'tag_id',
                    'user_id',
                    'project_id',
                    'page_number',
                    'line_number',
                    'paragraph_number',
                    'tag_type',
                    'send_to_final_report'
                ],
                'integer'
            ],
            [['note', 'sent_hl', 'entity_type', 'entity', 'selection'], 'string'],
            [['manual_date', 'meta_data'], 'string', 'max' => 50],
            [['positions'], 'string', 'max' => 200],
//            [['date_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExtractedDate::className(), 'targetAttribute' => ['date_id' => 'id']],
            [
                ['doc_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Documents::className(),
                'targetAttribute' => ['doc_id' => 'id']
            ],
//            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExtractedEntity::className(), 'targetAttribute' => ['entity_id' => 'id']],
            [
                ['project_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Projects::className(),
                'targetAttribute' => ['project_id' => 'id']
            ],
            [
                ['tag_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Tags::className(),
                'targetAttribute' => ['tag_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selection' => 'Selection',
            'docName' => 'Source Document',
//            'doc_id' => 'Doc ID',
            'tag_id' => 'Tag ID',
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
//            'entity_id' => 'Entity ID',
            'date_id' => 'Date ID',
            'note' => 'Note',
            'manual_date' => 'Manual Date',
            'page_number' => 'Page Number',
            'line_number' => 'Line Number',
            'paragraph_number' => 'Paragraph Number',
            'positions' => 'Positions',
            'sent_hl' => 'Highlight + Sentence',
            'meta_data' => 'Meta Data',
            'entity_type' => 'Entity 1 Type',
            'tag_type' => 'Tag Type',
            'entity' => 'Entity 1',
            'keywordString'  => 'Documents Keywords',
            'conceptString' => 'Documents Concepts',
            'send_to_final_report' => 'Send to final report'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Documents::className(), ['id' => 'doc_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return SentencesPlusHlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SentencesPlusHlQuery(get_called_class());
    }
}
