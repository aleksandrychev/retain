<?php

namespace app\models\ar;

/**
 * This is the ActiveQuery class for [[TagsResult]].
 *
 * @see TagsResult
 */
class TagsResultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagsResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagsResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
