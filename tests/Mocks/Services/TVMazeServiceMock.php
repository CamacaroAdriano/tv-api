<?php

namespace Tests\Mocks\Services;

use Illuminate\Support\Collection;
use Src\Contracts\TVMazeService as TVMazeServiceContract;

class TVMazeServiceMock implements TVMazeServiceContract
{
    public function filterShowsByNameInCollection(string $showName, Collection $shows): Collection
    {
        return $shows;
    }
}
