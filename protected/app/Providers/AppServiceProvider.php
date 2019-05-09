<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\SirupService;
use App\Services\Contracts\SirupServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Bind SIRUP Service
        $this->app->bind(SirupServiceInterface::class, SirupService::class);
    }
}
