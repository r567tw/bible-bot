<?php
namespace App\Services;

use GuzzleHttp\Client;

class DailyVerseService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getDailyVerse()
    {
        $url = 'https://www.taiwanbible.com/blog/dailyverse.jsp';

        $response = $this->client->get($url);
        $text = (string) trim($response->getBody());

        return $text;
    }
}
