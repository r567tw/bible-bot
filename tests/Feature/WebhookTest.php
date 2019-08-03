<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebhookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetDailyVerse()
    {
        $request = $this->webhookRequest('今日金句');
        $response = $this->post('webhook',$request);

        $response->assertStatus(200);
        $response->assertSeeText(':');
    }

    public function testQueryBible()
    {
        $request = $this->webhookRequest('查聖經:創,1,1');
        $response = $this->post('webhook',$request);

        $response->assertStatus(200);
        $response->assertSeeText('起初，神創造天地。');

    }

    private function webhookRequest($message)
    {
        return array (
            'events' =>
              array (
                0 =>
                array (
                  'type' => 'message',
                  'replyToken' => 'b7715478ee0d447e85078161e9fad18c',
                  'source' =>
                            array (
                                'userId' => 'U852ac49f59e5acd69648a9bcd5b99299',
                                'type' => 'user',
                            ),
                  'timestamp' => 1564820945283,
                  'message' =>
                            array (
                                'type' => 'text',
                                'id' => '10326564062583',
                                'text' => $message,
                            ),
                ),
              ),
              'destination' => 'U5a81c4026d970646b63cd9ebaafe705a',
        );
    }
}
