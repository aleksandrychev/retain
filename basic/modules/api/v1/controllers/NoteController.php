<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 15.08.16
 * Time: 10:26
 */

namespace app\modules\api\v1\controllers;


use app\models\ar\search\TagsResultSearch;
use app\models\ar\TagsResult;
use app\modules\api\common\controllers\BaseApiController;
use yii\web\NotFoundHttpException;


class NoteController extends BaseApiController
{
    public $modelClass = 'app\models\ar\TagsResult';

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
            $searchModel = new TagsResultSearch();
            $request = \Yii::$app->getRequest();

            $params = \Yii::$app->getRequest()->getQueryParams();
            $params['user_id'] = \Yii::$app->user->id;

            $dataProvider = $searchModel->search($params, $request->get('sort'));
            $dataProvider->pagination->pageSize = 9999;

            return $dataProvider;
        };

        return $actions;
    }

    private function findModel($id)
    {
        $model = TagsResult::find()
            ->where(['user_id' => \Yii::$app->user->id, 'id' => $id])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException("Object not found: $id");
        }

        return $model;
    }

    /**
     * @apiDefine NoteParams
     * @apiParam {string} text Note text
     * @apiParam {string} html Note html
     * @apiParam {string} note Note note
     * @apiParam {string} date Note date
     * @apiParam {string} color Note color
     * @apiParam {integer} doc_id Document Id
     * @apiParam {integer} tag_id Tag Id
     * @apiParam {integer} page_number Page Number
     * @apiParam {integer} line_number Line Number
     * @apiParam {integer} paragraph_number Paragraph Number
     * @apiParam {string} positions Selection object json
     **/

    /**
     * @api {get} v1/note?:field_name=:field_value&sort=:sort_field_name List
     * @apiName noteList
     * @apiGroup Note
     * @apiVersion 1.0.0
     *
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": [
     *      {
     *      "id": 1,
     *      "text": "Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp",
     *      "html": "<div class=\"t m0 x0 h3 y13 ff2 fs0 fc0 sc0 ls0 ws0\"><span class=\"_ _b\"> </span>Pacific<span class=\"_ _a\"> </span>Rim<span class=\"_ _b\"> </span>Mining<span class=\"_ _a\"> </span>Corp.<span class=\"_ _c\"> </span>In<span class=\"_ _a\"> </span>that<span class=\"_ _a\"> </span>capacity,<span class=\"_ _a\"> </span>m<span class=\"_ _9\"></span>y<span class=\"_ _d\"> </span>duties</div><div class=\"t m0 x0 h3 y14 ff2 fs0 fc0 sc0 ls0 ws0\">include<span class=\"_ _e\"> </span>overseeing<span class=\"_ _e\"> </span>the<span class=\"_ _e\"> </span>consolidated<span class=\"_ _e\"> </span>financial<span class=\"_ _e\"> </span>statements<span class=\"_ _e\"> </span>of<span class=\"_ _e\"> </span>P<span class=\"_ _9\"></span>acific<span class=\"_ _e\"> </span>Rim<span class=\"_ _e\"> </span>Mining<span class=\"_ _e\"> </span>Corp.<span class=\"_ _e\"> </span>and<span class=\"_ _e\"> </span>its</div><div class=\"t m0 x0 h3 y15 ff2 fs0 fc0 sc0 ls0 ws0\">subsidiaries<span class=\"_ _7\"> </span>(the<span class=\"_ _7\"> </span>“Pacific<span class=\"_ _d\"> </span>Rim<span class=\"_ _7\"> </span>Companies”<span class=\"_ _7\"> </span>or<span class=\"_ _7\"> </span>t<span class=\"_ _9\"></span>he<span class=\"_ _7\"> </span>“Companies”).<span class=\"_ _8\"> </span>I<span class=\"_ _7\"> </span>have<span class=\"_ _d\"> </span>full<span class=\"_ _7\"> </span>access<span class=\"_ _7\"> </span>to<span class=\"_ _7\"> </span>t<span class=\"_ _9\"></span>he<span class=\"_ _7\"> </span>books</div><div class=\"t m0 x0 h3 y16 ff2 fs0 fc0 sc0 ls0 ws0\">and<span class=\"_ _7\"> </span>records<span class=\"_ _d\"> </span>of<span class=\"_ _7\"> </span>Pa<span class=\"_ _9\"></span>cific<span class=\"_ _7\"> </span>Rim<span class=\"_ _d\"> </span>Mining<span class=\"_ _7\"> </span>Corp.<span class=\"_ _d\"> </span>and<span class=\"_ _d\"> </span>I<span class=\"_ _7\"> </span>am<span class=\"_ _d\"> </span>resp</div>",
     *      "note": null,
     *      "date": null,
     *      "doc_id": 106,
     *      "tag_id": 25,
     *      "user_id": 1,
     *      "page_number": 1,
     *      "line_number": 0,
     *      "paragraph_number": null,
     *      "positions": "{\"top\":\"439.4375\",\"right\":\"599.31640625\",\"bottom\":\"532.5\",\"left\":\"131.5\",\"width\":\"467.81640625\",\"height\":\"93.0625\",\"selector\":\"1\"}"
     *      }
     *   ]
     * }
     **/

    /**
     * @api {get} v1/note/:id View
     * @apiName noteView
     * @apiGroup Note
     * @apiVersion 1.0.0
     *
     * @apiParam {string} id Tag ID
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *  "id": 24,
     *  "text": "Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp",
     *  "html": null,
     *  "note": null,
     *  "date": null,
     *  "doc_id": 106,
     *  "tag_id": 28,
     *  "user_id": 1,
     *  "page_number": null,
     *  "line_number": null,
     *  "paragraph_number": null,
     *  "positions": null
     *  }
     * }
     */


    /**
     * @api {delete} v1/note/:id Delete
     * @apiName noteDelete
     * @apiGroup Note
     * @apiVersion 1.0.0
     *
     * @apiParam {integer} id Note ID
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 204 No Content
     */

    /**
     * @api {put} v1/note/:id Edit
     * @apiName noteEdit
     * @apiGroup Note
     * @apiVersion 1.0.0
     * @apiUse NoteParams
     *
     * @apiParam {integer} id Note ID
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *  "id": 24,
     *  "text": "Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp",
     *  "html": null,
     *  "note": null,
     *  "date": null,
     *  "doc_id": 106,
     *  "tag_id": 28,
     *  "user_id": 1,
     *  "page_number": null,
     *  "line_number": null,
     *  "paragraph_number": null,
     *  "positions": null
     *  }
     * }
     */

    /**
     * @api {post} v1/note Create
     * @apiName createNote
     * @apiGroup Note
     * @apiVersion 1.0.0
     * @apiUse NoteParams
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     *  "id": 24,
     *  "text": "Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp",
     *  "html": null,
     *  "note": null,
     *  "date": null,
     *  "doc_id": 106,
     *  "tag_id": 28,
     *  "user_id": 1,
     *  "page_number": null,
     *  "line_number": null,
     *  "paragraph_number": null,
     *  "positions": null
     *  }
     * }
     */


}