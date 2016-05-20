<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.04.16
 * Time: 16:10
 */

namespace app\models\convertImplementations;

use app\models\base\AbstractConverterBase;

class ConvertFromDocx extends AbstractConverterBase
{
    public function convertToHtml()
    {
        $uploadsDir = __DIR__ . '/../../web/uploads';
        $command = "cd $uploadsDir;";
        putenv('PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/opt/node/bin:/usr/lib64/libreoffice');
        $command .= '/usr/bin/unoconv  -o "pdf/'. $this->docID .'.pdf" -fpdf docx/'. $this->docID .'.docx;';
        $command .= 'pdf2htmlEX --tounicode 1   --dest-dir ./html ./pdf/' . $this->docID . '.pdf';

      
        exec($command, $output, $return_var);

        

    }
}