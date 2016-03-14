<?php

namespace app\models\ar;

/**
 * This is the ActiveQuery class for [[Documents]].
 *
 * @see Documents
 */
class DocumentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Documents[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Documents|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}