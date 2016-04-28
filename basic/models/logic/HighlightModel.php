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
use app\models\ar\SentencesPlusHl;
use app\models\ar\TagEntities;
use app\models\ar\TagsResult;
use yii\base\Model;

class HighlightModel extends Model
{
    private $shl;
    private $doc_id;
    private $selectedHtml;

    public  function __construct(SentencesPlusHl $shl, $doc_id, $selectedHtml)
    {
        $this->doc_id = $doc_id;
        $this->shl = $shl;
        $this->selectedHtml = strip_tags($selectedHtml);
        parent::__construct();
    }

    public function processHighlighting()
    {

        $this->setEntity();
        $this->setDate();
    }

    private function setEntity()
    {

        $entity = ExtractedEntity::find()->where(['=', 'document_id', $this->doc_id])->all();
        $justFounded = [];
        foreach ($entity as $en) {

            if (stristr($this->selectedHtml, $en->entity) AND !in_array($en->entity, $justFounded)) {
                $justFounded[] = $en->entity;
                $tagEntity = new SentencesPlusHl();
                $tagEntity->attributes = $this->shl->attributes;
                $tagEntity->entity_id = $en->id;
                $tagEntity->save();
            }
        }

    }

    private function setDate()
    {
        $dates = ExtractedDate::find()->where(['=', 'document_id', $this->doc_id])->all();
        $justFounded = [];
        foreach ($dates as $d) {

            if (stristr($this->selectedHtml, $d->date) AND !in_array($d->date, $justFounded)) {
                $justFounded[] = $d->date;
                $tagEntity = new SentencesPlusHl();
                $tagEntity->attributes = $this->shl->attributes;
                $tagEntity->date_id = $d->id;
               $tagEntity->save();
            }
        }
    }

//    public function buildAnswer($tagR){
//
//        $result = [];
//        $result['tag_result'] = $tagR->toArray();
//        $result['tag'] = $tagR->tag->toArray();
//        $result['doc'] = $tagR->doc->toArray();
//         if($tagR->tagEntities AND is_array($tagR->tagEntities)){
//             foreach($tagR->tagEntities as $te){
//                 $result['tag_entity'][]  = $te->toArray();
//             }
//         }
//        return json_encode($result);
//
//    }

}