<?php

namespace app\controllers;

use app\models\ar\Projects;
use app\models\logic\AutocompleteForm;

class AutocompleteController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new AutocompleteForm();
        $projects = Projects::find()->byUser()->all();

        $selectedProject = false;
        if ($model->project_id) {
            $selectedProject = Projects::find()->where(['id' => $model->project_id])->byUser()->one();
        }


        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->render('index',
                ['projects' => $projects, 'model' => $model, 'success' => true, 'selectedProject' => $selectedProject]);
        } else {
            return $this->render('index',
                ['projects' => $projects, 'model' => $model, 'selectedProject' => $selectedProject]);
        }

    }

    public function actionGetDoc(){

        error_reporting(E_ALL ^ E_STRICT);
        \VsWord::autoLoad();
        $documentDir =  __DIR__ .'/../docxes/';
        $doc = new \VsWord();
        $parser = new \HtmlParser($doc);
        $parser->parse($_POST['AutocompleteForm']['text'] );
        $docname = time() . rand(1,999) . '.docx';
        $doc->saveAs( $documentDir . $docname );


        $file = 'Project_Report_'.date('d-m-Y_H:i:s').'.docx';

        $fileLocation = $documentDir . $docname;
        header('Content-type: application/octet-stream');
        header('Content-Length: ' . filesize($fileLocation));
        header ("Content-Disposition: attachment; filename*=UTF-8'en'$file");
        header('Content-Transfer-Encoding: binary');
        readfile($fileLocation);
        unlink($fileLocation);
        exit(0);
    }

    public function actionMentions(){
       return json_encode([['name'=>'2borys2'],['name'=>'gryshko']]);
    }

}
