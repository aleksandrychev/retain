<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "sentences".
 *
 * @property integer $id
 * @property integer $doc_id
 * @property integer $tag_id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $entity_type
 * @property string $entity
 * @property string $sentence
 */
class Sentences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sentences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'user_id', 'project_id'], 'integer'],
            [['sentence'], 'string'],
            [['entity_type'], 'string', 'max' => 200],
            [['entity'], 'string', 'max' => 400],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['doc_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
            'entity_type' => 'Entity Type',
            'entity' => 'Entity',
            'sentence' => 'Sentence',
        ];
    }
}
