<?php

namespace Tests\Controllers\V1\TVMazeController;

use function route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SearchShowsByNameTest extends TestCase
{
    public function test_searchShowsByName(): void
    {
        $response = $this->json(
            'GET',
            route('shows.search', ['q' => 'show-name']),
        );

        $response->assertStatus(Response::HTTP_OK);
    }
}
