<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 15.03.16
 * Time: 11:27
 */

namespace app\models\logic;


use app\helpers\AppHelper;
use app\models\ar\Documents;
use app\models\ar\ExtractedDate;
use app\models\ar\ExtractedEntity;
use yii\base\Model;

class ProcessModel extends Model
{

    private $document;
    private $api;
    private $url;

    public function __construct(Documents $document)
    {
        $this->document = $document;
        $this->api = new AlchemyAPI();
        $this->url = AppHelper::getHtmlUrlById($this->document->id);

    }

    public function startProcess()
    {
        $this->processEntity();
        $this->processDate();

        header('location: /documents/view/' . $this->document->id);
        exit;
    }

    private function processEntity()
    {
        $entities = $this->api->textGetRankedNamedEntities($this->url);

        if ($entities && $entities->status == 'OK' && count($entities->entities) > 0) {
            foreach ($entities->entities as $entity) {
                $entity->full_sentence = AppHelper::getSentenceByPhrase($entity->text, $this->document->html_file);
                $this->saveEntity($entity);
            }
        }


    }

    private function processDate()
    {
        $dates = $this->api->textExtractDates($this->url);

        if ($dates && $dates->status == 'OK' && count($dates->dates) > 0) {
            foreach ($dates->dates as $date) {

                $date->full_sentence = AppHelper::getSentenceByPhrase($date->text, $this->document->html_file);
                $this->saveDate($date);
            }
        }
    }

    private function saveEntity($entity)
    {
        $extractedEntity = new ExtractedEntity();
        $extractedEntity->document_id = $this->document->id;
        $extractedEntity->type = $entity->type;
        $extractedEntity->entity = $entity->text;
        $extractedEntity->full_sentence = $entity->full_sentence;
        $extractedEntity->save();
    }

    private function saveDate($date)
    {
        $extractedEntity = new ExtractedDate();
        $extractedEntity->document_id = $this->document->id;
        $extractedEntity->date = $date->text;
        $extractedEntity->full_sentence = $date->full_sentence;
        $extractedEntity->save();
    }


}