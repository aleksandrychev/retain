<?php

namespace app\controllers;


use app\models\factories\ConvertStrategyFactory;
use yii\filters\AccessControl;
use app\models\logic\Converter;
use app\models\logic\ConverterManager;
use app\models\logic\ProcessModel;
use yii\web\UploadedFile;
use Yii;
use app\models\logic\UploadsModel;

class UploadController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLoad()
    {
        $model = new UploadsModel();

        if (Yii::$app->request->isPost) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $doc = $model->upload();
            if ($doc) {
                $converter = new ConverterManager(ConvertStrategyFactory::getImplementation($model->file->extension));

                $converter
                    ->setDocId($doc->id)
                    ->convertToHtml()
                    ->htmlSaveWithoutTags();

                $process = new ProcessModel($doc);
                $process->startProcess();

            }
        }

    }
}
