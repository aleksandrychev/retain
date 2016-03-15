<?php

namespace app\controllers;
use app\models\logic\AlchemyAPI;
use app\models\logic\Pdf2htmlExModel;
use yii\helpers\Url;
use yii\web\UploadedFile;
use Yii;
use app\models\logic\UploadsModel;
class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLoad()
    {
        $model = new UploadsModel();

        if (Yii::$app->request->isPost) {
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            $pdfName = $model->upload();
            if ($pdfName) {
                $pdfToHtml = new Pdf2htmlExModel($pdfName. '.pdf');
                $pdfToHtml->pdfToHtmlConvertion();
                $url =  Url::base('http') .  Url::to('/uploads/html/' . $pdfName . '.html');
                var_dump($url);exit;

                $api = new AlchemyAPI();
                $apires = $api->textExtractDates($url);
                var_dump($apires);exit;

                exit;
                return;
            }
        }

          }


    public function actionValidatepdf()
    {
        return $this->render('validatepdf');
    }

}
