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
use yii\base\Model;

class  EntityDateSetter extends Model
{
    private $shl;
    private $doc_id;
    private $text;
    private $modelToSave;

    public  function __construct($model, $modelToSave, $doc_id, $text)
    {
        $this->doc_id = $doc_id;
        $this->shl = $model;
        $this->modelToSave = $modelToSave;
        $this->text = strip_tags($text);
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

                    $tagEntity = new $this->modelToSave();
                    $tagEntity->type = $en->type;
                    $tagEntity->result_id =  $this->shl->id;
                    $tagEntity->entity_id = $en->id;
                    $tagEntity->entity_title = $en->entity;
                    $tagEntity->save();

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
                $tagEntity = new $this->modelToSave();
                $tagEntity->type = 'Date';
                $tagEntity->result_id =  $this->shl->id;
                $tagEntity->entity_id = $d->id;
                $tagEntity->entity_title = $d->date;
                $tagEntity->save();
            }
        }
    }
}