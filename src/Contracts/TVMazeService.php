<?php

namespace Src\Contracts;

use Illuminate\Support\Collection;

interface TVMazeService
{
    /**
     * Accepts a show name string and a shows Collection.
     * Filters Collection by name in a case-insensitive and in a typo-intolerant way.
     *
     * @param string $showName
     * @param Collection $shows
     * @return Collection
     */
    public function filterShowsByNameInCollection(string $showName, Collection $shows): Collection;
}
