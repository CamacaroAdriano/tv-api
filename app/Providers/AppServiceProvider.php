<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Clients\TVMazeClient;
use Src\Contracts\TVMazeClient as TVMazeClientContract;
use Tests\Mocks\Clients\TVMazeClientMock;

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
        } else {
            $this->app->bind(TVMazeClientContract::class, TVMazeClient::class);
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
