<?php

declare(strict_types=1);

namespace Src\Clients;

use Exception;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use function env;
use Illuminate\Support\Facades\Http;
use Src\Contracts\TVMazeClient as TVMazeClientContract;

class TVMazeClient implements TVMazeClientContract
{
    public const SEARCH_SHOW_PATH = 'search/shows';

    /** @inheritdoc */
    public function searchShowsByName(string $showName): Collection
    {
        /** @var ?ClientResponse $response */
        $response = $this->makeGetRequest(self::SEARCH_SHOW_PATH, ['q' => $showName]);

        return !empty($response) ? $response->collect() : collect();
    }

    /**
     * Accepts path and query params to call TV Maze GET endpoints.
     *
     * Returns ClientResponse instance only if status is equal to 200, otherwise returns null.
     * Throws Exception with error code 502 if external API returns >=500 status code.
     *
     * @param string $path
     * @param string[]|null $queryParams
     * @return ?ClientResponse
     * @throws Exception
     */
    protected function makeGetRequest(string $path, ?array $queryParams = null): ?ClientResponse
    {
        /** @var ClientResponse $response */
        $response = Http::get(env('TV_MAZE_API_URL') . $path, $queryParams);

        if ($response->serverError()) {
            throw new Exception(
                'Error when connecting to external service.',
                Response::HTTP_BAD_GATEWAY
            );
        }

        return $response->ok() ? $response : null;
    }
}
