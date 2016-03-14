<?php

namespace app\controllers;

class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
        return $this->render('upload');
    }

    public function actionValidatepdf()
    {
        return $this->render('validatepdf');
    }

}
