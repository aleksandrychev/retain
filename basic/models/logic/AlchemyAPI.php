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
    private $apiKey = '7ba9369c80e73f358e8d6ad4ac9d8f6cf796f9ec';
    private $dateApiUrl = 'http://gateway-a.watsonplatform.net/calls/text/URLExtractDates';
    private $entityApiUrl = 'http://gateway-a.watsonplatform.net/calls/url/URLGetRankedNamedEntities';

    public function setApiKey($key){
        $this->apiKey = $key;
    }

    public function textGetRankedNamedEntities($url){
        $data = [
            'apikey' => $this->apiKey,
            'outputMode'=> 'json',
            'showSourceText'=> 1,
            'url'=>$url
        ];

        return $this->callAPI($this->entityApiUrl, $data);
    }

    public function textExtractDates($url){

        $data = [
            'apikey' => $this->apiKey,
            'outputMode'=> 'json',
            'showSourceText'=> 1,
            'url'=>$url
        ];

       return $this->callAPI($this->dateApiUrl, $data);
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

        return $result;
    }

}