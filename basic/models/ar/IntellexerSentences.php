<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "intellexer_sentences".
 *
 * @property integer $id
 * @property string $sentence
 * @property integer $internal_id
 * @property integer $doc_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Documents $doc
 */
class IntellexerSentences extends \app\models\ar\base\IntellexerSentences
{

}
