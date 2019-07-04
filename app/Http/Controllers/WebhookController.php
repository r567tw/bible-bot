<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\Constant\HTTPHeader;
use App\Services\LineBotService;

class WebhookController extends Controller
{

    private $token = '';
    private $secret = '';
    private $service = '';


    public function __construct()
    {
        $this->token = env('LINEBOT_TOKEN');
        $this->secret = env('LINEBOT_SECRET');

        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);

        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);
    }

    public function index(Request $request)
    {
        // Log::info($request->all());

        $events = $request['events'];

        foreach ($events as $event) {
            // Log::info($event['replyToken']);
            if ($event['message']['type'] == 'text' && $event['message']['text'] == '今日金句'){
                $userId = $event['source']['userId'];
                $lineBotService = new LineBotService($userId);
                $http = new \GuzzleHttp\Client;
                $url = 'https://www.taiwanbible.com/blog/dailyverse.jsp';
                $response = $http->get($url);
                $text = (string) trim($response->getBody());
                $lineBotService->pushMessage($text);
            }else{
                $this->bot->replyText($event['replyToken'], '目前我暫時還學不會講話，請多給我一點時間！');
            }

        }
        return '';
    }
}
