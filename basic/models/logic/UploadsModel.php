<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 15:51
 */

namespace app\models\logic;


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
            $this->pdf->saveAs(__DIR__ . '/../../web/uploads/pdf/' . $pdfName);
            return $pdfName;
        } else {
            return false;
        }
    }

}