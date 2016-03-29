<?php

namespace app\controllers;

use app\helpers\AppHelper;
use app\models\logic\Pdf2htmlExModel;
use app\models\logic\ProcessModel;
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
            $doc = $model->upload();
            if ($doc) {
                $pdfToHtml = new Pdf2htmlExModel($doc->id);
                $pdfToHtml->pdfToHtmlConvertion();
                $pdfToHtml->htmlSaveWithoutTags();
                AppHelper::segmentationText($doc->id);


                while(!file_exists(__DIR__ . '/../web/uploads/json/' . $doc->id . '.html' )){
                    sleep(1);
                }

                $process = new ProcessModel($doc);
                $process->startProcess();

            }
        }

    }
}
