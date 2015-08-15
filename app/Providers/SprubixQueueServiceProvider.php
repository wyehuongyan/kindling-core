<?php

namespace App\Providers;

use App\Services\SprubixQueue;
use Illuminate\Support\ServiceProvider;

class SprubixQueueServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('sprubixQueue', function ($app) {
            return new SprubixQueue();
        });
    }
}
