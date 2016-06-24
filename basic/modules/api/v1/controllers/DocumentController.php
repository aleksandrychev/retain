<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 23.06.16
 * Time: 19:17
 */

namespace app\modules\api\v1\controllers;


use app\models\ar\Documents;
use app\modules\api\common\controllers\BaseApiController;
use yii\web\NotFoundHttpException;


class DocumentController extends BaseApiController
{

    public $modelClass = 'app\models\ar\Documents';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['update'], $actions['delete'], $actions['view']);
        return $actions;
    }

    public function actionHtml($uuid)
    {
        $document = Documents::find()->where(['uuid' => $uuid])->andWhere(['user' => \Yii::$app->user->id])->one();

        if (!$document) {
            throw new NotFoundHttpException('Document not found');
        }

        $file = __DIR__ . '/../../../../web/uploads/html/' . $document->html_file;

        if (file_exists($file)) {
            return file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Html file not found');
        }
    }


    /**
     * @api {get} v1/document/html/?uuid=xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx Html entity of document
     * @apiName documentHtml
     * @apiGroup Documents
     * @apiVersion 1.0.0
     *
     * @apiParam {string} uuid UUID of document
     *
     * @apiSuccessExample Success-Response:
     *{
     *    "success": true,
     *    "data": "<!DOCTYPE html>code</html>"
     * }
     */

}