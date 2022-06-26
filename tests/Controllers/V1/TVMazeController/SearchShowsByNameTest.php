<?php

namespace Tests\Controllers\V1\TVMazeController;

use function route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SearchShowsByNameTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [['q' => 'show-name'], Response::HTTP_OK],
            [['q' => ''], Response::HTTP_OK],
            [[], Response::HTTP_BAD_REQUEST],
        ];
    }

    /**
     * @param array $queryParams
     * @param int $status
     * @return void
     * @dataProvider dataProvider
     */
    public function test_searchShowsByName(array $queryParams, int $status): void
    {
        $response = $this->json('GET', route('shows.search-by-name', $queryParams));

        $response->assertStatus($status);
    }
}
