<?php

namespace app\models\ar\base;
use app\models\ar\Documents;
use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $title
 * @property integer $position
 * @property integer $user
 *
 * @property Documents[] $documents
 * @property User $user0
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'user'], 'integer'],
            [['text'], 'safe'],
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
            'text' => 'Autocompleted Text',
            'title' => 'Title',
            'position' => 'Position',
            'user' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * @inheritdoc
     * @return ProjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectsQuery(get_called_class());
    }
}
