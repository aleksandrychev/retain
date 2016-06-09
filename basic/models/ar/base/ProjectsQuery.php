<?php

namespace app\models\ar\base;

/**
 * This is the ActiveQuery class for [[Projects]].
 *
 * @see Projects
 */
class ProjectsQuery extends \yii\db\ActiveQuery
{
      public function byUser()
    {
        return $this->andWhere(['user' => \Yii::$app->user->id]);
    }

    /**
     * @inheritdoc
     * @return Projects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Projects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
