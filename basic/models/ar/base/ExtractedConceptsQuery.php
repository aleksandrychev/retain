<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[ExtractedConcepts]].
 *
 * @see ExtractedConcepts
 */
class ExtractedConceptsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ExtractedConcepts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExtractedConcepts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
