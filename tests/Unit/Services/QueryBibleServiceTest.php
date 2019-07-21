<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\QueryBibleService;
use GuzzleHttp\Client;

class QueryBibleServiceTest extends TestCase
{
    public function testQueryBible()
    {
        $service = new QueryBibleService(new Client());

        $response = $service->getData(['book'=>'創','chap'=>'1','sec' => '1']);
        $this->assertStringContainsString('起初，神創造天地。',$response);
    }
}
