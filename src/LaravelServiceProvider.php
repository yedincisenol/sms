<?php

namespace App\Providers;

use yedincisenol\Sms\Sms;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/Sms.php' => config_path('sms.php'),
        ], 'sms');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(
            __DIR__.'Config/Sms.php', 'sms'
        );

        $this->app->singleton(Sms::class, function ($app) {
            return new Sms(config('sms.default_driver'), config('sms'));
        });
    }
}