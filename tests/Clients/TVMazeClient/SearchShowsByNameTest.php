<?php

namespace Tests\Clients\TVMazeClient;

use Illuminate\Support\Facades\Http;
use Src\Clients\TVMazeClient;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SearchShowsByNameTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [['show-1', 'show-2', 'show-3'], Response::HTTP_OK],
            [null, Response::HTTP_BAD_REQUEST],
            [null, Response::HTTP_INTERNAL_SERVER_ERROR],
        ];
    }

    /**
     * @param array|null $responseBody
     * @param int $status
     * @return void
     * @dataProvider dataProvider
     */
    public function testSearchShowsByNameMethod(?array $responseBody, int $status): void
    {
        Http::fake(['*' => Http::response(['show-1', 'show-2', 'show-3'], $status)]);

        $this->assertEquals(collect($responseBody), (new TVMazeClient())->searchShowsByName('show'));
    }
}
