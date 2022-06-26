<?php

namespace Tests\Clients\TVMazeClient;

use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
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
            [null, Response::HTTP_FOUND],
        ];
    }

    /**
     * @param ?array $expectedReturnValue
     * @param int $status
     * @return void
     * @dataProvider dataProvider
     * @throws Exception
     */
    public function testSearchShowsByNameMethod(?array $expectedReturnValue, int $status): void
    {
        Http::fake(['*' => Http::response(['show-1', 'show-2', 'show-3'], $status)]);
        $this->assertEquals(collect($expectedReturnValue), (new TVMazeClient())->searchShowsByName('show'));

        Http::assertSent(function (Request $request) {
            return $request->url() === env('TV_MAZE_API_URL') . TVMazeClient::SEARCH_SHOW_PATH . '?q=show';
        });
    }

    public function testSearchShowsByNameShouldThrowException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(Response::HTTP_BAD_GATEWAY);

        Http::fake(['*' => Http::response([], Response::HTTP_INTERNAL_SERVER_ERROR)]);

        (new TVMazeClient())->searchShowsByName('show');
    }

    /**
     * @throws Exception
     */
    public function testSearchShowsByNameShouldReturnCachedValue(): void
    {
        $showName = 'show';
        $cachedResult = collect();

        Http::fake();
        Cache::shouldReceive('has')->once()->with($showName)->andReturnTrue();
        Cache::shouldReceive('get')->once()->with($showName)->andReturn($cachedResult);

        $this->assertEquals($cachedResult, (new TVMazeClient())->searchShowsByName($showName));

        Http::assertNothingSent();
    }

    /**
     * @throws Exception
     */
    public function testSearchShowsByNameShouldCallExternalApiAndCacheResult(): void
    {
        $showName = 'show';

        Http::fake();
        Cache::shouldReceive('has')->once()->with($showName)->andReturnFalse();
        Cache::shouldReceive('put');

        (new TVMazeClient())->searchShowsByName($showName);

        Http::assertSent(function (Request $request) use ($showName) {
            return $request->url() === env('TV_MAZE_API_URL') . TVMazeClient::SEARCH_SHOW_PATH . '?q=' . $showName;
        });
    }
}
