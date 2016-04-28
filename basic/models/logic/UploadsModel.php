<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 15:51
 */

namespace app\models\logic;


use app\models\ar\base\Projects;
use app\models\ar\Documents;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadsModel extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;


    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['pdf','doc','docx']],

        ];
    }

    public function upload()
    {
        $post = Yii::$app->request->post();

        if ($this->validate() && $this->validateProject($post)) {
            $fileName = $this->file->baseName . '.' . $this->file->extension;
            $doc = new Documents();
            $doc->createDocumentByName($fileName);
            $doc->project_id = $post['UploadsModel']['projectId'];
            $doc->save();
            $this->file->saveAs(__DIR__ . '/../../web/uploads/'. $this->file->extension .'/' . $doc->id . '.' . $this->file->extension);
            return $doc;
        } else {
            return false;
        }
    }

    private  function  validateProject($post){

         if(empty($post['UploadsModel']['projectId'])){
             throw new NotFoundHttpException('The projectId must be inserted.');
         }

        $project = Projects::findOne($post['UploadsModel']['projectId']);

        if(!$project){
            throw new NotFoundHttpException('The project not found.');
        }

        if($project->user != Yii::$app->user->id){
            throw new NotFoundHttpException('You can\'t user this project.');
        }


        return true;

}

}