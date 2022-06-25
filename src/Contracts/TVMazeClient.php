<?php

namespace Src\Contracts;

interface TVMazeClient
{
    /**
     * Accepts a show name string and calls TV MAZE API to search shows by name.
     *
     * @param string $showName
     * @return ?array
     */
    public function searchShowsByName(string $showName): ?array;
}
