<?php

namespace app\controllers;

use app\models\ar\MasterReportSettings;
use Yii;
use app\models\ar\SentencesPlusHl;
use app\models\ar\search\SentencesPlusHlSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterReportController implements the CRUD actions for SentencesPlusHl model.
 */
class MasterReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
     * Lists all SentencesPlusHl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SentencesPlusHlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(isset($_POST) AND isset($_POST['columns'])){
        MasterReportSettings::setSettings();
         }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => new SentencesPlusHl(),
            'settings' => MasterReportSettings::getSettings(),
        ]);
    }




    /**
     * Finds the SentencesPlusHl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SentencesPlusHl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SentencesPlusHl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
