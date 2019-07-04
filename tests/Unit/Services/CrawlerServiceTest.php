<?php
namespace Tests\Unit\Services;

use App\Services\CrawlerService;
use Tests\TestCase;

class CrawlerServiceTest extends TestCase
{
    public function testGetOriginalData()
    {
        $service = new CrawlerService();
        $crawler = $service->getOriginalData('https://www.taiwanbible.com/blog/dailyverse.jsp');
        $this->assertNotEmpty($crawler->html());
    }
}
