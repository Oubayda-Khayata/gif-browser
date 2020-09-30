<?php

namespace App\Providers;

use App\Services\GIFEngine;
use Illuminate\Support\ServiceProvider;

class GIFEngineProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GIFEngine::class, function () {
            return new GIFEngine(config('services.gif_engine.key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
