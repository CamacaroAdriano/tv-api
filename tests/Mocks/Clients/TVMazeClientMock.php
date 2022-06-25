<?php

declare(strict_types=1);

namespace Tests\Mocks\Clients;

use Illuminate\Support\Collection;
use Src\Contracts\TVMazeClient as TVMazeClientContract;

class TVMazeClientMock implements TVMazeClientContract
{
    /** @inheritdoc */
    public function searchShowsByName(string $showName): Collection
    {
        return collect();
    }
}
