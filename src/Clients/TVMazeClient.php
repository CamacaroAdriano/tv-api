<?php

declare(strict_types=1);

namespace Src\Clients;

use Illuminate\Http\Client\Response;
use function env;
use Illuminate\Support\Facades\Http;
use Src\Contracts\TVMazeClient as TVMazeClientContract;

class TVMazeClient implements TVMazeClientContract
{
    public const SEARCH_SHOW_PATH = 'search/shows';

    /** @inheritdoc */
    public function searchShowsByName(string $showName): ?array
    {
        /** @var ?Response $response */
        $response = $this->makeGetRequest(self::SEARCH_SHOW_PATH, ['q' => $showName]);

        return !empty($response) ? $response->json() : null;
    }

    /**
     * Accepts path and query params to call TV Maze GET endpoints.
     * Will return Response instance only if status is equal to 200.
     *
     * @param string $path
     * @param ?array|string[]|int[] $queryParams
     * @return ?Response
     */
    protected function makeGetRequest(string $path, ?array $queryParams = null): ?Response
    {
        /** @var Response $response */
        $response = Http::get(env('TV_MAZE_API_URL') . $path, $queryParams);

        return $response->ok() ? $response : null;
    }
}
