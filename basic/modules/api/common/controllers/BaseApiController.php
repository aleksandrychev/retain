<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 21.06.16
 * Time: 19:38
 */

namespace app\modules\api\common\controllers;


use yii\filters\auth\HttpBearerAuth;
use Yii;
use yii\rest\ActiveController;

class BaseApiController extends ActiveController
{
    public $count = 999;

      public function beforeAction($action)
    {
      
        $this->setHeaders();
        if (\Yii::$app->getRequest()->isOptions) {
            return false;
        }

        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['bearerAuth'] = [
            'class' => HttpBearerAuth::className(),
            'except' => []
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {

        if ($model &&  isset($model->user) &&  $model->user != \Yii::$app->user->identity->getId()) {
            throw new ForbiddenHttpException('Access deny');
        }

    }


    protected  function setHeaders(){
        header('Access-Control-Request-Headers: *');
        header('Access-Control-Allow-Headers: accept, content-type, authorization');
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        }
        header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT, DELETE');
        header('Access-Control-Allow-Credentials: true');
    }

}