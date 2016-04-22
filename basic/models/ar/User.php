<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property string $last_visit_time
 * @property string $create_time
 * @property string $update_time
 * @property string $delete_time
 *
 * @property Documents[] $documents
 * @property ProfileFieldValue[] $profileFieldValues
 * @property Tags[] $tags
 */
class User extends \app\models\ar\base\User
{

}
