<?php

namespace app\controllers;
use app\models\logic\AlchemyAPI;
use app\models\logic\Pdf2htmlExModel;
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
                $html = strip_tags(file_get_contents(__DIR__ . '/../web/uploads/html/' . $pdfName . '.html'));

                $api = new AlchemyAPI();
                $apires = $api->textExtractDates($html);
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
