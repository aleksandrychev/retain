<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[TagEntities]].
 *
 * @see TagEntities
 */
class TagEntitiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagEntities[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagEntities|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
