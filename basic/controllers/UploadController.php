<?php

namespace app\controllers;
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
                $pdfToHtml = new Pdf2htmlExModel($pdfName);
                $pdfToHtml->pdfToHtmlConvertion();
               var_dump($pdfName);exit;
                return;
            }
        }

          }


    public function actionValidatepdf()
    {
        return $this->render('validatepdf');
    }

}
