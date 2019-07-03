<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\LineBotService;

class LineBotServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPushMessage()
    {
        $lineService = new LineBotService(env('LINE_USER_ID'));
        $response = $lineService->pushMessage('Test Hello World');

        $this->assertEquals(200, $response->getHTTPStatus());
    }

    public function testBuildTemplateMessageBuilder()
    {
        $lineService = new LineBotService(env('LINE_USER_ID'));
        $target = $lineService->buildTemplateMessageBuilder(
            'https://i.imgur.com/BlBH2HE.jpg',
            'https://github.com/Tai-ch0802/php-crawler-chat-bot',
            '自己玩的linebot'
        );
        $response =  $lineService->pushMessage($target);

        $this->assertEquals(200, $response->getHTTPStatus());
    }
}
