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
    public $pdf;

    public function rules()
    {
        return [
            [['pdf'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $pdfName = $this->pdf->baseName . '.' . $this->pdf->extension;

            $doc = new Documents();
            $doc->createDocumentByName($pdfName);
            $this->pdf->saveAs(__DIR__ . '/../../web/uploads/pdf/' . $doc->id . '.pdf');
            return  $doc->id;
        } else {
            return false;
        }
    }

}