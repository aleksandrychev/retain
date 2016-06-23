<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 21.06.16
 * Time: 19:41
 */

namespace app\modules\api\v1\controllers;


use app\modules\api\common\controllers\BaseApiController;
use auth\models\LoginForm;
use auth\models\User;
use yii\helpers\ArrayHelper;

class AuthController extends BaseApiController
{
    public $modelClass = 'auth\models\User';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['bearerAuth']['except'] = ArrayHelper::merge($behaviors['bearerAuth']['except'], ['login']);
        return $behaviors;
    }

    public function actionLogin()
    {
        $loginModel = new LoginForm();
        $loginModel->load(\Yii::$app->request->post(), '');
        if (!$loginModel->login()) {
            return $loginModel;
        }

        $user = $loginModel->getUser();
        $user->setNewAuthKey();

        return [
            'success' => true,
            'access_token' => $user->getAuthKey(),
            'user' => ['id' => $user->id, 'userName' => $user->username, 'email' => $user->email]
        ];
    }


    public function actionLogout()
    {

        $user = User::find()->where(['id' => \Yii::$app->getUser()->getIdentity()->getId()])->one();
        $user->auth_key = '';
        $user->save();

        return [];
    }


    /**
     * @api {post} v1/auth/login Login user
     * @apiName userLogin
     * @apiGroup Authorization
     * @apiVersion 1.0.0
     *
     * @apiParam {string} email Email of User
     * @apiParam {string} password Password of User
     *
     * @apiSuccessExample Success-Response:
     * {
     *   "success": true,
     *   "access_token": "iGtdHnDQkdyZPJHR780-as_wWMSYzoBm",
     *   "user": {
     *      "id": 1,
     *      "userName": "admin",
     *      "email": "ad@min.com"
     *      }
     * }
     */

    /**
     * @api {post} v1/auth/logout Logout user
     * @apiName userLogout
     * @apiGroup Authorization
     *
     * @apiSuccessExample Success-Response:
     * {
     *   "success": true,
     * }
     */

}