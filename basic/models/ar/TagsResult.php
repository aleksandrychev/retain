<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "tags_result".
 *
 * @property integer $id
 * @property string $text
 * @property string $note
 * @property integer $doc_id
 * @property integer $tag_id
 * @property integer $page_number
 * @property string $positions
 *
 * @property TagEntities[] $tagEntities
 * @property Tags $tag
 * @property Documents $doc
 */
class TagsResult extends \app\models\ar\base\TagsResult
{

}
