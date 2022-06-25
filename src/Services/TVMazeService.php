<?php

namespace Src\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Src\Contracts\TVMazeService as TVMazeServiceContract;

class TVMazeService implements TVMazeServiceContract
{
    public function filterShowsByNameInCollection(string $showName, Collection $shows): Collection
    {
        if ($shows->isEmpty()) {
            return $shows;
        }

        return $shows
            ->filter(fn($value) => Str::contains(Arr::get($value, 'show.name'), $showName, true))
            ->values();
    }
}
