<?php

namespace app\models\ar\base;

use Yii;

/**
 * This is the model class for table "sentence_entities".
 *
 * @property integer $result_id
 * @property string $type
 * @property integer $entity_id
 * @property string $entity_title
 *
 * @property Sentences $result
 */
class SentenceEntities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sentence_entities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result_id', 'entity_id'], 'integer'],
            [['entity_title'], 'string'],
            [['type'], 'string', 'max' => 20],
            [['result_id', 'entity_id', 'type'], 'unique', 'targetAttribute' => ['result_id', 'entity_id', 'type'], 'message' => 'The combination of Result ID, Type and Entity ID has already been taken.'],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sentences::className(), 'targetAttribute' => ['result_id' => 'id']],
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
            'entity_title' => 'Entity Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(Sentences::className(), ['id' => 'result_id']);
    }
}
