<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 21.06.16
 * Time: 20:32
 */

namespace app\modules\api\v1\controllers;


use app\models\ar\Projects;
use app\modules\api\common\controllers\BaseApiController;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;


class ProjectController extends BaseApiController
{
    public $modelClass = 'app\models\ar\Projects';
    public $count = 999;

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = function () {
            $query = Projects::find()->select('id, title')->where(['user' => \Yii::$app->user->identity->getId()]);
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $this->count,
                ]
            ]);
        };


        return $actions;
    }



    /**
     * @api {get} v1/project List
     * @apiName projectList
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "title": "ProjectX",
     * "position": 0,
     * "user": 1,
     * "text": null
     * },
     * {
     * "id": 2,
     * "title": "Project 2",
     * "position": 0,
     * "user": 1,
     * "text": "html of project report"
     * }]}
     */

    /**
     * @api {get} v1/project/:id View
     * @apiName projectView
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {string} id Project ID
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     * "id": 39,
     * "title": "title of project",
     * "position": 0,
     * "user": 1,
     * "text": "text of project, will be an html"
     * }
     * }
     */

    /**
     * @api {get} v1/project/:id?expand=documents Documents of project
     * @apiName projectdocuments
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {string} id Project ID
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     * "id": 1,
     * "title": "ProjectX",
     * "position": 0,
     * "user": 1,
     * "text": null,
     * "documents": [
     * {
     * "id": 1,
     * "project_id": 1,
     * "user": 1,
     * "title": "demo.docx",
     * "uploaded_date": 1462433362,
     * "user_ip": "193.84.22.110",
     * "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36",
     * "html_file": "1.html",
     * "uuid":  "8029b331-12c2-11e6-a0ac-061c72b17085"
     * },
     * {
     * "id": 14,
     * "project_id": 1,
     * "user": 1,
     * "title": "p.pdf",
     * "uploaded_date": 1462453726,
     * "user_ip": "193.84.22.110",
     * "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36",
     * "html_file": "14.html",
     * "uuid": "8029b331-12c2-11e6-a0ac-061c72b17085"
     * }
     * ]
     * }
     * }
     */

    /**
     * @api {get} v1/project/:id?expand=entity Entities of project
     * @apiName projectEntities
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {string} id Project ID
     * @apiParam {integer} tag_type ```1``` - manual tag (note) ```0``` - auto inserted entity
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     * "id": 1,
     * "title": "ProjectX",
     * "position": 0,
     * "user": 1,
     * "text": null,
     * "entity": [
     * {
     *  {
     *      "name": "tag",
     *      "type": "tag"
     *  },
     *  {
     *      "name": "12-09-1098",
     *      "type": "date"
     *  },
     *  {
     *      "name": "USA",
     *      "type": "entity"
     *  },
     *  {
     *      "name": "Pacific Rim Mining Corp.",
     *      "type": "entity"
     *  }
     * ]
     * }
     * }
     */


    /**
     * @api {delete} v1/project/:id Delete
     * @apiName projectDelete
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {integer} id Project ID
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 204 No Content
     */

    /**
     * @api {put} v1/project/:id Edit
     * @apiName projectEdit
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {integer} id Project ID
     * @apiParam {string} title Title of project
     * @apiParam {string} text Text of project
     *
     * @apiSuccessExample Success-Response:
     * {
     * "success": true,
     * "data": {
     * "id": 8,
     * "title": "new title",
     * "position": 0,
     * "user": 1,
     * "text": "new text"
     * }
     * }
     */

    /**
     * @api {post} v1/project Create
     * @apiName createProject
     * @apiGroup Projects
     * @apiVersion 1.0.0
     *
     * @apiParam {string} title Title of project
     * @apiParam {string} text Text of project
     *
     * @apiSuccessExample Success-Response:
     *{
     * "success": true,
     * "data": {
     * "title": "title of project",
     * "text": "text of project, will be an html",
     * "user": 1,
     * "id": 40
     * }
     * }
     */

}