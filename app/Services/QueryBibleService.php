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
        // input: ['book'=>'創', 'chap' => '1', 'sec' => '1']
        $query['gb'] = '0';
        $query['chineses'] = $query['book'];
        unset($query['book']);

        $response = $this->client->request(
            'GET',
            'http://bible.fhl.net/json/qb.php',
            ['query'=> $query]
        );

        $text = json_decode($response->getBody());

        $content = '';

        foreach ($text->record as $record) {
            $content .= $record->bible_text;
        }

        return $content;
    }
}
