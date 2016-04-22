<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 16:10
 */

namespace app\models\convertImplementations;

use app\models\base\AbstractConverterBase;

class ConvertFromDoc extends AbstractConverterBase
{
    public function convertToHtml()
    {
        $uploadsDir = __DIR__ . '/../../web/uploads';
        $command = "cd $uploadsDir;";
        $command .= 'sudo /usr/bin/unoconv -o "pdf/'. $this->docID .'.pdf" -fpdf doc/'. $this->docID .'.doc;';
        $command .= 'pdf2htmlEX  --dest-dir ./html ./pdf/' . $this->docID . '.pdf';
        exec($command, $output, $return_var);

    }
}