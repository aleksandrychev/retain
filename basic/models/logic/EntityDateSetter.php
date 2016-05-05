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

class  EntityDateSetter extends Model
{
    private $shl;
    private $doc_id;
    private $text;

    public  function __construct(SentencesPlusHl $shl, $doc_id)
    {
        $this->doc_id = $doc_id;
        $this->shl = $shl;
        $this->text = strip_tags($shl->sent_hl);
        parent::__construct();
    }

    public function process()
    {

        $this->setEntity();
        $this->setDate();
    }

    private function setEntity()
    {

        $entity = ExtractedEntity::find()->where(['=', 'document_id', $this->doc_id])->all();
        $justFounded = [];
        foreach ($entity as $en) {

            if (stristr($this->text, $en->entity) AND !in_array($en->entity, $justFounded)) {
                $justFounded[] = $en->entity;

                if ($this->shl->entity_type) {
                    $tagEntity = new SentencesPlusHl();
                    $tagEntity->attributes = $this->shl->attributes;
                    $tagEntity->tag_type = 0;
                    $tagEntity->entity_type = $en->type;
                    $tagEntity->entity = $en->entity;
                    $tagEntity->save();
                } else{
                    $this->shl->entity_type = $en->type;
                    $this->shl->entity = $en->entity;
                    $this->shl->save();
                }


            }
        }

    }

    private function setDate()
    {
        $dates = ExtractedDate::find()->where(['=', 'document_id', $this->doc_id])->all();
        $justFounded = [];
        foreach ($dates as  $d) {

            if (stristr($this->text, $d->date) AND !in_array($d->date, $justFounded)) {
                $justFounded[] = $d->date;
                if ($this->shl->entity_type) {
                    $tagEntity = new SentencesPlusHl();
                    $tagEntity->attributes = $this->shl->attributes;
                    $tagEntity->tag_type = 0;
                    $tagEntity->entity_type = 'Date';
                    $tagEntity->entity =  $d->date;
                    $tagEntity->save();
                } else {
                    $this->shl->entity_type = 'Date';
                    $this->shl->entity =  $d->date;
                    $this->shl->save();
                }
            }
        }
    }
}