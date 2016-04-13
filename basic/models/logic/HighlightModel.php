<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 13.04.16
 * Time: 15:08
 */

namespace app\models\logic;


use app\models\ar\ExtractedDate;
use app\models\ar\ExtractedEntity;
use app\models\ar\TagEntities;
use yii\base\Model;

class HighlightModel extends Model
{
     private $res_id;
     private $doc_id;
     private $selectedHtml;

    public function processHighlighting($res_id, $doc_id, $selectedHtml)
    {
        $this->doc_id = $doc_id;
        $this->res_id = $res_id;
        $this->selectedHtml = strip_tags($selectedHtml);

        $this->setEntity();
        $this->setDate();

    }

    private function setEntity(){

        $entity = ExtractedEntity::find()->where(['=','document_id', $this->doc_id])->all();

        foreach($entity as  $en){

            if (stristr($this->selectedHtml,$en->entity)){
                $tagEntity = new TagEntities();
                $tagEntity->entity_id = $en->id;
                $tagEntity->result_id = $this->res_id;
                $tagEntity->type = 'entity';
                $tagEntity->save();
            }
        }

    }

    private function setDate(){
        $dates = ExtractedDate::find()->where(['=','document_id', $this->doc_id])->all();

        foreach($dates as  $d){

            if (stristr($this->selectedHtml,$d->date)){
                $tagEntity = new TagEntities();
                $tagEntity->entity_id = $d->id;
                $tagEntity->result_id = $this->res_id;
                $tagEntity->type = 'date';
                $tagEntity->save();
            }
        }
    }
}