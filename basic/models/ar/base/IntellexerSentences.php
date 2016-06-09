<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "intellexer_sentences".
 *
 * @property integer $id
 * @property string $sentence
 * @property integer $internal_id
 * @property integer $doc_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Documents $doc
 */
class IntellexerSentences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'intellexer_sentences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'doc_id', 'user_id'], 'integer'],
            [['sentence'], 'string', 'max' => 2000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'sentence' => 'Sentence',
            'internal_id' => 'Internal ID',
            'doc_id' => 'Doc ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Documents::className(), ['id' => 'doc_id']);
    }
}
