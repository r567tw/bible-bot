<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\LineBotService;

class WebhookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExampleDailyVerse()
    {
        $lineService = new LineBotService(env('LINE_USER_ID'));
        $http = new \GuzzleHttp\Client;
        $url = 'https://www.taiwanbible.com/blog/dailyverse.jsp';
        $response = $http->get($url);
        $text = (string) trim($response->getBody());
        $lineService->pushMessage($text);

        $this->assertTrue(true);
    }
}
