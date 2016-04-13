<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "tags_result".
 *
 * @property integer $id
 * @property string $text
 * @property string $note
 * @property integer $doc_id
 * @property integer $tag_id
 * @property integer $page_number
 * @property string $positions
 */
class TagsResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'note'], 'string'],
            [['doc_id', 'tag_id', 'page_number'], 'integer'],
            [['positions'], 'string', 'max' => 200],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
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
            'text' => 'Text',
            'note' => 'Note',
            'doc_id' => 'Doc ID',
            'tag_id' => 'Tag ID',
            'page_number' => 'Page Number',
            'positions' => 'Positions',
        ];
    }
}
