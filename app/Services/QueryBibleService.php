<?php
namespace App\Services;

use GuzzleHttp\Client;
use function GuzzleHttp\json_encode;

class QueryBibleService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getData(Array $query)
    {
        if ($query['status']){
            $input = $query['data'];
            // input: ['book'=>'創', 'chap' => '1', 'sec' => '1']
            $input['gb'] = '0';
            $input['chineses'] = $input['book'];
            unset($input['book']);

            $response = $this->client->request(
                'GET',
                'http://bible.fhl.net/json/qb.php',
                ['query'=> $input]
            );

            $text = json_decode($response->getBody());

            $content = '';

            foreach ($text->record as $record) {
                $content .= $record->bible_text;
            }

            return $content;
        }else{
            return '此訊息在處理過程當中有錯誤';
        }
    }
}
