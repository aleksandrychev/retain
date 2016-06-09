<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[SentencesPlusHl]].
 *
 * @see SentencesPlusHl
 */
class SentencesPlusHlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SentencesPlusHl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SentencesPlusHl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
