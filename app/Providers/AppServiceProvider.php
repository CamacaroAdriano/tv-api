<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Clients\TVMazeClient;
use Src\Contracts\TVMazeClient as TVMazeClientContract;
use Src\Contracts\TVMazeService as TVMazeServiceContract;
use Src\Services\TVMazeService;
use Tests\Mocks\Clients\TVMazeClientMock;
use Tests\Mocks\Services\TVMazeServiceMock;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment() === 'testing') {
            $this->app->bind(TVMazeClientContract::class, TVMazeClientMock::class);
            $this->app->bind(TVMazeServiceContract::class, TVMazeServiceMock::class);
        } else {
            $this->app->bind(TVMazeClientContract::class, TVMazeClient::class);
            $this->app->bind(TVMazeServiceContract::class, TVMazeService::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
