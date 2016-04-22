<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 15:52
 */

namespace app\models\convertImplementations;

use app\models\base\AbstractConverterBase;

class ConvertFromPdf extends AbstractConverterBase
{

    public function convertToHtml()
    {

        $uploadsDir = __DIR__ . '/../../web/uploads';
        $command = "cd $uploadsDir;";
        $command .= 'pdf2htmlEX  --dest-dir ./html ./pdf/' . $this->docID . '.pdf';
        exec($command, $output, $return_var);
    }

}