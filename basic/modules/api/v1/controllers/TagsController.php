<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 15.08.16
 * Time: 9:50
 */

namespace app\modules\api\v1\controllers;


use app\models\ar\Tags;
use app\modules\api\common\controllers\BaseApiController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class TagsController extends BaseApiController
{
    public $modelClass = 'app\models\ar\Tags';

    public function actions()
    {
        $actions = parent::actions();

        $actions['update']['findModel'] = function ($id) {
            return $this->findModel($id);
        };

        $actions['view']['findModel'] = function ($id) {
            return $this->findModel($id);
        };

        $actions['delete']['findModel'] = function ($id) {
            return $this->findModel($id);
        };

        $actions['index']['prepareDataProvider'] = function () {
            $query = Tags::find()->select('id, title')
                ->where(['user' => \Yii::$app->user->identity->getId()]);
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $this->count,
                ]
            ]);
        };

        return $actions;
    }

    private function findModel($id)
    {
        $model = Tags::find()
            ->where(['user' => \Yii::$app->user->id,'id' =>$id])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException("Object not found: $id");
        }

        return $model;
    }



    /**
     * @api {get} v1/tags List
     * @apiName tagsList
     * @apiGroup Tags
     * @apiVersion 1.0.0
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": [
     *      {
     *       "id": 7,
     *       "title": "tag"
     *       },
     *       {
     *       "id": 25,
     *      "title": "tag title"
     *      },
     *      {
     *      "id": 28,
     *       "title": "tag title 2"
     *      }
     *   ]
     * }
     */

    /**
     * @api {get} v1/tags/:id View
     * @apiName tagsView
     * @apiGroup Tags
     * @apiVersion 1.0.0
     *
     * @apiParam {string} id Tag ID
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *      "id": 28,
     *      "user": 1,
     *      "title": "title of tag",
     *      "parent_id": null
     *  }
     * }
     */



    /**
     * @api {delete} v1/tags/:id Delete
     * @apiName tagsDelete
     * @apiGroup Tags
     * @apiVersion 1.0.0
     *
     * @apiParam {integer} id Tag ID
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 204 No Content
     */

    /**
     * @api {put} v1/tags/:id Edit
     * @apiName tagsEdit
     * @apiGroup Tags
     * @apiVersion 1.0.0
     *
     * @apiParam {integer} id Tag ID
     * @apiParam {string} title Title of tag
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *      "id": 28,
     *      "user": 1,
     *      "title": "edited title of tag",
     *      "parent_id": null
     *  }
     * }
     */

    /**
     * @api {post} v1/tags Create
     * @apiName createTags
     * @apiGroup Tags
     * @apiVersion 1.0.0
     *
     * @apiParam {string} title Title of tag
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *      "id": 28,
     *      "user": 1,
     *      "title": "title of tag",
     *      "parent_id": null
     *  }
     * }
     */


}