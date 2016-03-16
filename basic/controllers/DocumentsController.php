<?php

namespace app\controllers;

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
        ];
    }

    /**
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Documents::find(),
        ]);

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $model,
            'url' => Url::base('http') .  Url::to('/uploads/html/' . $model->html_file),

        ]);
    }

    public function actionHtml($id){
//        ini_set('memory_limit','1048MB');
        $model = $this->findModel($id);

        $htmlContent = file_get_contents(__DIR__ . '/../web/uploads/html/' .  $model->html_file);

        $htmlContent = preg_replace("/<img[^>]+\>/i", "", $htmlContent);
        $htmlContent = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $htmlContent);
        $htmlContent = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $htmlContent);
        $htmlContent = preg_replace('/class=".*?"/', '', $htmlContent);
        $htmlContent = preg_replace('/id=".*?"/', '', $htmlContent);
        $htmlContent = preg_replace('/style=".*?"/', '', $htmlContent);


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
