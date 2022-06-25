<?php

namespace Src\Contracts;

use Exception;
use Illuminate\Support\Collection;

interface TVMazeClient
{
    /**
     * Accepts a show name string and calls TV MAZE API to search shows by name.
     *
     * @param string $showName
     * @return Collection
     * @throws Exception
     */
    public function searchShowsByName(string $showName): Collection;
}
