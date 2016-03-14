<?php

namespace app\controllers;
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
