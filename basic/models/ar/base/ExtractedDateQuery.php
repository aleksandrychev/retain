<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[ExtractedDate]].
 *
 * @see ExtractedDate
 */
class ExtractedDateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ExtractedDate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExtractedDate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}