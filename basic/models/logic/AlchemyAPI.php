<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.03.16
 * Time: 19:35
 */

namespace app\models\logic;


class AlchemyAPI
{
    private $urlDoc;
    private $apiKey = '7ba9369c80e73f358e8d6ad4ac9d8f6cf796f9ec';
    private $dateApiUrl = 'http://gateway-a.watsonplatform.net/calls/url/URLExtractDates';
    private $entityApiUrl = 'http://gateway-a.watsonplatform.net/calls/url/URLGetRankedNamedEntities';
    private $keywordsApiUrl = 'http://gateway-a.watsonplatform.net/calls/url/URLGetRankedKeywords';
    private $conceptsApiUrl = 'http://gateway-a.watsonplatform.net/calls/url/URLGetRankedConcepts';
    private $data;

    public function init()
    {


        $this->data = [
            'apikey' => \Yii::$app->params['alchemyApi'],
            'outputMode' => 'json',
            'maxRetrieve' => 500,
            'showSourceText' => 0,
            'url' => $this->urlDoc
        ];
   
        return $this;
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function setUrl($url)
    {
        $this->urlDoc = $url;
        return $this;
    }

    public function textGetRankedNamedEntities()
    {
        return $this->callAPI($this->entityApiUrl, $this->data);
    }

    public function textExtractDates()
    {
        return $this->callAPI($this->dateApiUrl, $this->data);
    }


    public function textExtractKeywords()
    {
        $data = $this->data;
        $data['maxRetrieve'] = 5;
        return $this->callAPI($this->keywordsApiUrl, $data);
    }

    public function textExtractConcepts()
    {
        $data = $this->data;
        $data['maxRetrieve'] = 5;
        return $this->callAPI($this->conceptsApiUrl, $data);
    }


    private function callAPI($url, $data)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result);
    }

}