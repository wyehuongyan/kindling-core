<?php namespace App\Providers;

use App\Services\SprubixMail;
use Illuminate\Support\ServiceProvider;

class SprubixMailServiceProvider extends ServiceProvider
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
        $this->app->singleton('sprubixMail', function ($app) {
            return new SprubixMail();
        });
    }
}
