<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "intellexer_clusterize".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property integer $sentence_ids
 * @property integer $doc_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Documents $doc
 */
class IntellexerClusterize extends \app\models\ar\base\IntellexerClusterize
{

}
