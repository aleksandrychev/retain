<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[ExtractedKeywords]].
 *
 * @see ExtractedKeywords
 */
class ExtractedKeywordsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ExtractedKeywords[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExtractedKeywords|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
