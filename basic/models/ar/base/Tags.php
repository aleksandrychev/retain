<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property integer $user
 * @property string $title
 * @property integer $parent_id
 *
 * @property User $user0
 * @property TagsResult[] $tagsResults
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'parent_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
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
            'parent_id' => 'Parent ID',
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
    public function getTagsResults()
    {
        return $this->hasMany(SentencesPlusHl::className(), ['tag_id' => 'id']);
    }
}
