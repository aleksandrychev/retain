<?php

namespace app\controllers;

use app\helpers\AppHelper;
use app\models\ar\search\DocumentSearch;
use app\models\ar\TagsResult;
use yii\filters\AccessControl;
use Yii;
use app\models\ar\Documents;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return !\Yii::$app->user->getIsGuest();
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Documents model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if($model->user != Yii::$app->user->id){
            throw new NotFoundHttpException('The requested page does not exist.');
            return false;
        }

        if (isset($_GET['resId']) && !empty($_GET['resId'])) {
            $curHl = TagsResult::find()->where(['user'=>Yii::$app->user->id])->where(['=', 'id', $_GET['resId']])->one();
        } else {
            $curHl = false;
        }

        return $this->render('view', [
            'model' => $model,
            'url' => Url::base('http') . Url::to('/uploads/html/' . $model->html_file),
            'tagResults' => TagsResult::find()->where(['user'=>Yii::$app->user->id])->where(['=', 'doc_id', $model->id])->all(),
            'curHl' => $curHl

        ]);
    }

    public function actionHtml($id)
    {
        ini_set('memory_limit', '2048M');
        ini_set('pcre.backtrack_limit', '200M');

        $model = $this->findModel($id);

        $htmlContent = file_get_contents(__DIR__ . '/../web/uploads/html/' . $model->html_file);
        $htmlContent = AppHelper::clearHtml($htmlContent);

        echo $htmlContent;
    }


    /**
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
