<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Services\DailyVerseService;
use App\Services\QueryBibleService;
use Illuminate\Support\Str;

use App\Transformers\Requests\WebhookRequestTransformer;

class WebhookResponseService
{
    private $client;

    public function __construct(
        DailyVerseService $dailyVerse,
        QueryBibleService $bibleService
    )
    {
        $this->client = new Client();
        $this->dailyVerse = $dailyVerse;
        $this->bibleService = $bibleService;
    }


    public function returnResponse($request)
    {
        if ($request['type'] == 'text'){
            return $this->processTextMessage($request['text']);
        }

        return '目前我暫時還學不會這些話，請多給我一點時間吧！';
    }

    private function processTextMessage($message){

        switch ($message) {
            case '今日金句':
                return $this->dailyVerse->getDailyVerse();
            case Str::startsWith($message,'查聖經:'):
                return $this->bibleService->queryBible($message);
            default:
                return '目前我無法處理此訊息～Developer 之後將開發更多新功能，盡請期待！';
        }
    }

}
