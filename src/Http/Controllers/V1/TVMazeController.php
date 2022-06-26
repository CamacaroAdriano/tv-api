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
        if (!$request->has('q')) {
            throw new Exception('Missing required parameter: q', Response::HTTP_BAD_REQUEST);
        }

        /** @var ?string $showName */
        $showName = $request->query('q', '');

        return response()->json(
            $this->service->filterShowsByNameInCollection($showName, $this->client->searchShowsByName($showName)),
            Response::HTTP_OK
        );
    }
}
