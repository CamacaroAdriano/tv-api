<?php

declare(strict_types=1);

namespace Src\Clients;

use Illuminate\Http\Client\Response;
use function env;
use Illuminate\Support\Facades\Http;
use Src\Contracts\TVMazeClient as TVMazeClientContract;

class TVMazeClient implements TVMazeClientContract
{
    /** @inheritdoc */
    public function searchShowsByName(string $showName): ?array
    {
        /** @var Response $response */
        $response = Http::get(env('TV_MAZE_API_URL') . 'search/shows', ['q' => $showName]);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }
}
