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
use app\models\ar\ExtractedConcepts;
use app\models\ar\ExtractedDate;
use app\models\ar\ExtractedEntity;
use app\models\ar\ExtractedKeywords;
use app\models\ar\SentencesPlusHl;
use yii\base\Model;

class ProcessModel extends Model
{

    private $document;
    private $api;
    private $url;

    /*
     * @Todo : make process more flexible, add save manager and process manager
     *
     */
//    private $processes = [
//        [ 'apiMethod' => 'textGetRankedNamedEntities', 'jsonEntity' => 'entities'],
//        [ 'apiMethod' => 'textGetRankedNamedEntities', 'jsonEntity' => 'entities'],
//        [ 'apiMethod' => 'textGetRankedNamedEntities', 'jsonEntity' => 'entities'],
//        [ 'apiMethod' => 'textGetRankedNamedEntities', 'jsonEntity' => 'entities'],
//    ];

    public function __construct(Documents $document)
    {
        $this->document = $document;
        $this->api = new AlchemyAPI();
        $this->url = AppHelper::getHtmlUrlById(Documents::findOne($this->document->id)->uuid);

        $this->api->setUrl($this->url)->init();

    }

    public function startProcess()
    {
        $this->checkSentencesDocument();
        $this->processEntity();
        $this->processDate();
        $this->processKeywords();
        $this->processConcepts();
        $this->writeSentenceToDb();

        header('location: /documents/view/' . $this->document->id);
        exit;
    }

    private function checkSentencesDocument()
    {
        $i = 0;
        while (!file_exists(__DIR__ . '/../../web/uploads/json/' . $this->document->id . '.html')) {
            if ($i++ > 610) {
                break;
            }
            sleep(1);
        }
    }

    private function writeSentenceToDb()
    {
        $sentences = AppHelper::getDocumentSentences($this->document->html_file);

        foreach($sentences as $s){
            $sentHL = new SentencesPlusHl();
            $sentHL->sent_hl = $s;
            $sentHL->doc_id = $this->document->id;
            $sentHL->user_id = \Yii::$app->user->id;
            $sentHL->save();

            $entityDateSetter = new EntityDateSetter($sentHL,$this->document->id);
            $entityDateSetter->process();

        }
    }



    private function processEntity()
    {
        $entities = $this->api->textGetRankedNamedEntities();
        if ($entities && $entities->status == 'OK' && count($entities->entities) > 0) {
            foreach ($entities->entities as $entity) {
                $entity->full_sentence = AppHelper::getSentenceByPhrase($entity->text, $this->document->html_file,
                    false);
                $this->saveEntity($entity);
            }

        }


    }

    private function processDate()
    {
        $dates = $this->api->textExtractDates();
        AppHelper::$tempSent = [];
        if ($dates && $dates->status == 'OK' && count($dates->dates) > 0) {
            foreach ($dates->dates as $date) {

                $date->full_sentence = AppHelper::getSentenceByPhrase($date->text, $this->document->html_file, true);
                $this->saveDate($date);
            }

        }
    }

    private function processKeywords()
    {
        $keywords = $this->api->textExtractKeywords(); //keywords
        if ($keywords && $keywords->status == 'OK' && count($keywords->keywords) > 0) {
            foreach ($keywords->keywords as $k) {
                $this->saveKC($k, new ExtractedKeywords());
            }
        }
    }

    private function processConcepts()
    {
        $concepts = $this->api->textExtractConcepts(); //keywords
        if ($concepts && $concepts->status == 'OK' && count($concepts->concepts) > 0) {
            foreach ($concepts->concepts as $c) {
                $this->saveKC($c, new ExtractedConcepts());
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

    private function saveKC($res, $item)
    {
        $item->text = $res->text;
        $item->relevance = $res->relevance;
        $item->doc_id = $this->document->id;
        $item->save();

    }


}