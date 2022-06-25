<?php

namespace Tests\Services\TVMazeService;

use Src\Services\TVMazeService;
use Tests\TestCase;

class FilterShowsByNameInCollectionTest extends TestCase
{
    public function dataProvider(): array
    {
        $providers = [];

        $providers[] = [
            'Deadwood',
            [['show' => ['name' => 'Deadwood']]]
        ];

        $providers[] = [
            'deadwood',
            [['show' => ['name' => 'Deadwood']]]
        ];

        $providers[] = [
            'Dead',
            [
                ['show' => ['name' => 'Deadpool']],
                ['show' => ['name' => 'Deadwood']]
            ]
        ];

        $providers[] = [
            'dead',
            [
                ['show' => ['name' => 'Deadpool']],
                ['show' => ['name' => 'Deadwood']]
            ]
        ];

        $providers[] = [
            'Wood',
            [
                ['show' => ['name' => 'Redwood Kings']],
                ['show' => ['name' => 'Deadwood']],
            ]
        ];

        $providers[] = [
            'wood',
            [
                ['show' => ['name' => 'Redwood Kings']],
                ['show' => ['name' => 'Deadwood']],
            ]
        ];

        $providers[] = [
            'oo',
            [
                ['show' => ['name' => 'Deadpool']],
                ['show' => ['name' => 'Redwood Kings']],
                ['show' => ['name' => 'Deadwood']],
            ]
        ];

        $providers[] = ['random', []];

        return $providers;
    }

    /**
     * @param string $showName
     * @param array $expectedResults
     * @return void
     * @dataProvider dataProvider
     */
    public function testSearchShowsByNameInCollectionMethod(string $showName, array $expectedResults): void
    {
        $shows = collect([
            ['show' => ['name' => 'Deadpool']],
            ['show' => ['name' => 'Redwood Kings']],
            ['show' => ['name' => 'Deadwood']],
        ]);

        $this->assertEquals(
            collect($expectedResults),
            (new TVMazeService())->filterShowsByNameInCollection($showName, $shows)
        );
    }
}
