<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "extracted_entity".
 *
 * @property integer $id
 * @property string $type
 * @property string $entity
 * @property string $full_sentence
 * @property integer $document_id
 *
 * @property Documents $document
 */
class ExtractedEntity extends \app\models\ar\base\ExtractedEntity
{

}
