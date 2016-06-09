<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "intellexer_clusterize".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $sentence_ids
 * @property integer $doc_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Documents $doc
 */
class IntellexerClusterize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'intellexer_clusterize';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'doc_id', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['sentence_ids'], 'string', 'max' => 400],
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
            'title' => 'Title',
            'parent_id' => 'Parent ID',
            'sentence_ids' => 'Sentence Ids',
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
