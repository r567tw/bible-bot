<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\DailyVerseService;
use GuzzleHttp\Client;

class DailyVerseServiceTest extends TestCase
{
    public function testGetDailyVerseFunction()
    {
        $service = new DailyVerseService(new Client());

        $response = $service->getDailyVerse();

        $this->assertStringContainsString(':',$response);
    }
}
