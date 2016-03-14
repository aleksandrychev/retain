<?php

namespace app\controllers;

use app\models\logic\UploadsModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PdfToHtml;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $mu = new UploadsModel();
        return $this->render('index',['modelUpload' => $mu]);
    }

    public function actionLoad()
    {

        if($_FILES){
            $files = glob(__DIR__ . '/../web/files/*'); // get all file names
            foreach($files as $file){ // iterate files
                if(is_file($file))
                    unlink($file); // delete file
            }

            if(move_uploaded_file($_FILES['pdf']['tmp_name'],__DIR__ . '/../web/files/pdf.pdf')){
                exec('pdftohtml '.__DIR__ . '/../web/files/pdf.pdf '.' -xml');
                echo 'pdftohtml '.__DIR__ . '/../web/files/pdf.pdf '.' -xml';
                echo '<script> window.location= "/viewpdf" </script>';
            }

        }

    }

    public function actionViewpdf()
    {
        $pdf = new PdfToHtml();
        $pdfstring = $pdf->readPdf();

        return $this->render('viewpdf', ['pdfstring'=>$pdfstring]);
    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
