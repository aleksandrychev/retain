<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "sentences".
 *
 * @property integer $id
 * @property integer $doc_id
 * @property integer $user_id
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
            [['doc_id', 'user_id'], 'integer'],
            [['sentence'], 'string'],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['doc_id' => 'id']],
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
            'sentence' => 'Sentence',
        ];
    }
}
