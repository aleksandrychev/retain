<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "tag_entities".
 *
 * @property integer $result_id
 * @property string $type
 * @property integer $entity_id
 */
class TagEntities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_entities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result_id', 'entity_id'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['result_id', 'entity_id', 'type'], 'unique', 'targetAttribute' => ['result_id', 'entity_id', 'type'], 'message' => 'The combination of Result ID, Type and Entity ID has already been taken.'],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => TagsResult::className(), 'targetAttribute' => ['result_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'type' => 'Type',
            'entity_id' => 'Entity ID',
        ];
    }

    /**
     * @inheritdoc
     * @return TagEntitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagEntitiesQuery(get_called_class());
    }
}
