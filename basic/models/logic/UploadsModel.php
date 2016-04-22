<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 15:51
 */

namespace app\models\logic;


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
        if ($this->validate()) {
            $fileName = $this->file->baseName . '.' . $this->file->extension;
            $doc = new Documents();
            $doc->createDocumentByName($fileName);
            $this->file->saveAs(__DIR__ . '/../../web/uploads/'. $this->file->extension .'/' . $doc->id . '.' . $this->file->extension);
            return $doc;
        } else {
            return false;
        }
    }

}