<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\QueryBibleService;
use GuzzleHttp\Client;

class QueryBibleServiceTest extends TestCase
{
    public function testQueryBibleFunction()
    {
        $service = new QueryBibleService(new Client());

        $response = $service->queryBible("查聖經:創,1,1");

        $this->assertStringContainsString('起初，神創造天地。',$response);
    }
}
