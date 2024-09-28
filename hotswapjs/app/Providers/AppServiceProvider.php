<?php

namespace App\Providers;

use App\Contracts\FrontendServiceInterface;
use App\Services\FrontendService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FrontendServiceInterface::class, FrontendService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
