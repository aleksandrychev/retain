<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property integer $user
 * @property string $title
 * @property integer $parent_id
 *
 * @property User $user0
 * @property TagsResult[] $tagsResults
 */
class Tags extends \app\models\ar\base\Tags
{

}
