<?php
namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Services\DailyVerseService;

class WebhookResponseService
{
    private $client;

    public function __construct(DailyVerseService $dailyVerse)
    {
        $this->client = new Client();
        $this->dailyVerse = $dailyVerse;
    }


    public function returnResponse($event)
    {
        if ($event['message']['type'] == 'text'){
            return $this->processTextMessage($event);
        }

        return '目前我暫時還學不會這些話，請多給我一點時間吧！';
    }

    private function processTextMessage($event){
        switch ($event['message']['text']) {
            case '今日金句':
                return $this->dailyVerse->getDailyVerse();
            default:
                return '目前我無法處理此訊息～請Developer 多花一點心力開發！';
        }
    }
}
