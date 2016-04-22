<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[ExtractedEntity]].
 *
 * @see ExtractedEntity
 */
class ExtractedEntityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ExtractedEntity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExtractedEntity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}