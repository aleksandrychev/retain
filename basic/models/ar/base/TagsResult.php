<?php

namespace app\models\ar\base;

#use app\models\ar\Documents as Documents;
use app\models\ar\Tags;
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
 *
 * @property TagEntities[] $tagEntities
 * @property Tags $tag
 * @property Documents $doc
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
            [['text', 'note','date','html','color'], 'string'],
            [['doc_id', 'tag_id', 'page_number', 'user_id'], 'integer'],
            [['doc_id'], 'required'],
//            [['tag_id','note'],'checkTag'],
            [['doc_id', 'tag_id'], 'checkUserId'],
            [['positions'], 'string', 'max' => 200],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['doc_id' => 'id']],
        ];
    }

    public function checkUserId($att){

        if($att == 'tag_id' && !Tags::find()->where(['user' => \Yii::$app->user->id, 'id' => $this->tag_id])->exists()){
            $this->addError('tag_id','Tag ID is invalid.');
        }

        if($att == 'doc_id' && !Documents::find()->where(['user' => \Yii::$app->user->id, 'id' => $this->doc_id])->exists()){
            $this->addError('doc_id','Document ID is invalid.');
        }

    }

    public function checkTag($attr){
        if(!empty($this->note) && empty($this->tag_id)){
            $this->addError($attr,'Tag ID cannot be blank.');
        }
    }

    public function beforeValidate()
    {
        $this->user_id = \Yii::$app->user->id;
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'html' => 'Html',
            'color' => 'Color',
            'date' => 'Date',
            'note' => 'Note',
            'doc_id' => 'Doc ID',
            'tag_id' => 'Tag ID',
            'page_number' => 'Page Number',
            'positions' => 'Positions',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagEntities()
    {
        return $this->hasMany(TagEntities::className(), ['result_id' => 'id']);
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
    public function getDoc()
    {
        return $this->hasOne(Documents::className(), ['id' => 'doc_id']);
    }

    /**
     * @inheritdoc
     * @return TagsResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsResultQuery(get_called_class());
    }
}
