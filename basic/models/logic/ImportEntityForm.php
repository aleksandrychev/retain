<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 13.06.16
 * Time: 16:26
 */

namespace app\models\logic;


use yii\base\Model;

class ImportEntityForm extends Model
{
    public $csvFile;


    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['csv']],
        ];
    }

    public function upload()
    {
        $post = Yii::$app->request->post();

        if ($this->validate() && $this->validateProject($post)) {
//            $fileName = $this->file->baseName . '.' . $this->file->extension;
var_dump($this->csvFile);
//            $this->csvFile->saveAs(__DIR__ . '/../../web/uploads/'. $this->file->extension .'/' . $doc->id . '.' . $this->file->extension);

        } else {
            return false;
        }
    }

    private  function  validateProject($post){

        if(empty($post['ImportEntityForm']['projectId'])){
            throw new NotFoundHttpException('The projectId must be inserted.');
        }

        $project = Projects::findOne($post['ImportEntityForm']['projectId']);

        if(!$project){
            throw new NotFoundHttpException('The project not found.');
        }

        if($project->user != Yii::$app->user->id){
            throw new NotFoundHttpException('You can\'t user this project.');
        }


        return true;

    }

}