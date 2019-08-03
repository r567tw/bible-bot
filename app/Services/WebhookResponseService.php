<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Services\DailyVerseService;
use App\Services\QueryBibleService;
use Illuminate\Support\Str;

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


    public function returnResponse($event)
    {
        if ($event['message']['type'] == 'text'){
            return $this->processTextMessage($event);
        }

        return '目前我暫時還學不會這些話，請多給我一點時間吧！';
    }

    private function processTextMessage($event){
        $message = $this->tramsforTextMessage($event['message']['text']);
        switch ($message) {
            case '今日金句':
                return $this->dailyVerse->getDailyVerse();
            case Str::startsWith($message,'查聖經:'):
                $query = $this->prepareDataForQueryBible($message);
                return $this->bibleService->getData($query);
            default:
                return '目前我無法處理此訊息～請Developer 多花一點心力開發！';
        }
    }

    private function tramsforTextMessage($message){
        //將訊息全形英數轉半形
        $message = mb_convert_kana($message,'a');
        return $message;
    }

    private function prepareDataForQueryBible($message){
        // return ['book'=>'創', 'chap' => '1', 'sec' => '1']
        try {
            $query = explode(',',substr($message, 10));
        } catch (\Throwable $th) {
            return ['status'=> false];
        }
        return ['status'=> true,'data'=>array_combine(['book','chap','sec'],$query)];
    }


}
