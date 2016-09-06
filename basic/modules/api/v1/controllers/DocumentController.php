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
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


class DocumentController extends BaseApiController
{

    public $modelClass = 'app\models\ar\Documents';

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
            $query = Documents::find()->where(['user' => \Yii::$app->user->identity->getId()]);
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $this->count,
                ]
            ]);
        };
        unset($actions['delete'], $actions['update'], $actions['index']);
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

    private function findModel($id)
    {
        $model = Documents::find()
            ->where(['user' => \Yii::$app->user->id, 'id' => $id])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException("Object not found: $id");
        }

        return $model;
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

    /**
     * @api {get} v1/document/:id?:field_name=:field_value&sort=:sort_field_name&expand=:expand_item View
     * @apiName documentView
     * @apiGroup Documents
     * @apiParam {string=notes,entities,dates} expand_item Name of items to expand (coma separated)
     * @apiVersion 1.0.0
     *
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     * "id": 106,
     * "project_id": 32,
     * "user": 1,
     * "title": "WITNESS STATEMENT OF STEVEN K. KRAUSE.pdf",
     * "uploaded_date": 1465290826,
     * "user_ip": "109.238.77.106",
     * "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36",
     * "html_file": "106.html",
     * "uuid": "23535e3c-2c90-11e6-967c-061c72b17085",
     * "notes": [
     * {
     * "id": 1,
     * "text": " Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp",
     * "html": "<div class=\"t m0 x0 h3 y13 ff2 fs0 fc0 sc0 ls0 ws0\"><span class=\"_ _b\"> </span>Pacific<span class=\"_ _a\"> </span>Rim<span class=\"_ _b\"> </span>Mining<span class=\"_ _a\"> </span>Corp.<span class=\"_ _c\"> </span>In<span class=\"_ _a\"> </span>that<span class=\"_ _a\"> </span>capacity,<span class=\"_ _a\"> </span>m<span class=\"_ _9\"></span>y<span class=\"_ _d\"> </span>duties</div><div class=\"t m0 x0 h3 y14 ff2 fs0 fc0 sc0 ls0 ws0\">include<span class=\"_ _e\"> </span>overseeing<span class=\"_ _e\"> </span>the<span class=\"_ _e\"> </span>consolidated<span class=\"_ _e\"> </span>financial<span class=\"_ _e\"> </span>statements<span class=\"_ _e\"> </span>of<span class=\"_ _e\"> </span>P<span class=\"_ _9\"></span>acific<span class=\"_ _e\"> </span>Rim<span class=\"_ _e\"> </span>Mining<span class=\"_ _e\"> </span>Corp.<span class=\"_ _e\"> </span>and<span class=\"_ _e\"> </span>its</div><div class=\"t m0 x0 h3 y15 ff2 fs0 fc0 sc0 ls0 ws0\">subsidiaries<span class=\"_ _7\"> </span>(the<span class=\"_ _7\"> </span>“Pacific<span class=\"_ _d\"> </span>Rim<span class=\"_ _7\"> </span>Companies”<span class=\"_ _7\"> </span>or<span class=\"_ _7\"> </span>t<span class=\"_ _9\"></span>he<span class=\"_ _7\"> </span>“Companies”).<span class=\"_ _8\"> </span>I<span class=\"_ _7\"> </span>have<span class=\"_ _d\"> </span>full<span class=\"_ _7\"> </span>access<span class=\"_ _7\"> </span>to<span class=\"_ _7\"> </span>t<span class=\"_ _9\"></span>he<span class=\"_ _7\"> </span>books</div><div class=\"t m0 x0 h3 y16 ff2 fs0 fc0 sc0 ls0 ws0\">and<span class=\"_ _7\"> </span>records<span class=\"_ _d\"> </span>of<span class=\"_ _7\"> </span>Pa<span class=\"_ _9\"></span>cific<span class=\"_ _7\"> </span>Rim<span class=\"_ _d\"> </span>Mining<span class=\"_ _7\"> </span>Corp.<span class=\"_ _d\"> </span>and<span class=\"_ _d\"> </span>I<span class=\"_ _7\"> </span>am<span class=\"_ _d\"> </span>resp</div>",
     * "note": null,
     * "date": null,
     * "doc_id": 106,
     * "tag_id": 25,
     * "user_id": 1,
     * "page_number": 1,
     * "line_number": 0,
     * "paragraph_number": null,
     * "positions": "{\"top\":\"439.4375\",\"right\":\"599.31640625\",\"bottom\":\"532.5\",\"left\":\"131.5\",\"width\":\"467.81640625\",\"height\":\"93.0625\",\"selector\":\"1\"}",
     * "color": null
     * }],
     * "entities": [
     *  {
     * "id": 5553,
     * "type": "Company",
     * "entity": "Pacific Rim Mining Corp.",
     * "full_sentence": "I currently serve, on a part-time, contract basis, as the Chief Financial Officer (“CFO”) for Pacific Rim Mining Corp.",
     * "document_id": 106
     * },
     * {
     * "id": 5554,
     * "type": "Company",
     * "entity": "Pacific Rim Mining Corp",
     * "full_sentence": "I currently serve, on a part-time, contract basis, as the Chief Financial Officer (“CFO”) for Pacific Rim Mining Corp.",
     * "document_id": 106
     * }],
     * "dates": [
     * {
     * "id": 1699,
     * "date": "1998",
     * "full_sentence": "I will state at the outset that I worked for the Companies from 1998 to 2002, and then from October 2008 to the present, so I was not present at the Companies for several of the changes in corporate structure that I will discuss in my Witness Statement.",
     * "document_id": 106
     * },
     * {
     * "id": 1700,
     * "date": "2002",
     * "full_sentence": "I will state at the outset that I worked for the Companies from 1998 to 2002, and then from October 2008 to the present, so I was not present at the Companies for several of the changes in corporate structure that I will discuss in my Witness Statement.",
     * "document_id": 106
     * }]
     *
     **/


}