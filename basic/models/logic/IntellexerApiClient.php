<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.05.16
 * Time: 13:04
 */

namespace app\models\logic;


use Httpful\Httpful;

class IntellexerApiClient
{
    private $apiKey = '2c3c5576-c8bc-4bec-b6d9-33239cdfbbf7';

    public function clusterize($url)
    {
        return $this->call($url, 'clusterize');
    }

    private function call($url, $apiMethod = 'clusterize')
    {
        $data = [
            'apikey' => $this->apiKey,
            'url' => urldecode($url),
            'conceptsRestriction' => '20',
            'fullTextTrees' => 'true',
            'loadSentences' => 'true',
        ];
 

        $response = \Httpful\Request::get('http://api.intellexer.com/' . $apiMethod . '?' . http_build_query($data))
            ->expectsJson()
            ->send();
 
        return $response->body;

    }

}