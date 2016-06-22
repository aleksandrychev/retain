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


    public function init()
    {
         $this->setHeaders();
         parent::init();
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


    protected  function setHeaders(){
        header('Access-Control-Request-Headers: *');
        header('Access-Control-Allow-Headers: accept, content-type');
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        }
        header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT, DELETE');
        header('Access-Control-Allow-Credentials: true');
    }

}