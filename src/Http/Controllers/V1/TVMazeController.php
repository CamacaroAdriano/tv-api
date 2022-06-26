<?php

namespace Src\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Src\Contracts\TVMazeClient as TVMazeClientContract;
use Src\Contracts\TVMazeService as TVMazeServiceContract;
use Symfony\Component\HttpFoundation\Response;

class TVMazeController extends Controller
{
    protected TVMazeClientContract $client;
    protected TVMazeServiceContract $service;

    public function __construct(TVMazeClientContract $client, TVMazeServiceContract $service)
    {
        $this->client = $client;
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function searchShowsByName(Request $request): JsonResponse
    {
        /** @var ?string $showName */
        $showName = $request->query('q', '');

        /** @var Collection $shows */
        $shows = $this->client->searchShowsByName($showName);

        return response()->json(
            $this->service->filterShowsByNameInCollection($showName, $shows),
            Response::HTTP_OK
        );
    }
}
