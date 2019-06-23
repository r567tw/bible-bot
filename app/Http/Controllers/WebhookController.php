<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{

    private $token = 'oquKUUZO1oX2p8LMV4V0fI1i8KmkYnhxf+jW6UxkNSk11qBcXW2kMS7X9e5fBl3GRjYZBpl3Q4qVGGP04cIuXnQzzKNO3+W+xo3EqGmqbbl/eE31uftzg6c2paeTekA4KXtELUEanhpIOze3RF7q3wdB04t89/1O/w1cDnyilFU=';
    private $secret = '';

    private $lineUserId = '';

    private $lineMessage = '8acbb1b97ad224edbb606c7af87fa7c0';

    private $lineReplyToken = '';

    private $lineType = '';
    //

    public function __construct()
    {
        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);

        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);
    }

    public function index()
    {
        //獲取原始資訊
        $jsonString = file_get_contents('php://input');
        //轉成JSON
        $jsonObj = json_decode($jsonString, true);

        foreach ($jsonObj['events'] as $event) {
            //Line ID
            $this->lineUserId = $event['source']['userId'];
            //message 類型，
            $this->lineType = $event['message']['type'];
            //消息文本
            $this->lineMessage = $event['message']['text'];
            //回覆token
            $this->lineReplyToken = $event['replyToken'];

            $this->bot->replyText($this->lineReplyToken, 'Hello world');
        }
    }
}
