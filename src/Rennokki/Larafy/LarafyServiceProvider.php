<?php

namespace Rennokki\Larafy;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class LarafyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/larafy.php' => config_path('larafy.php'),
        ]);

        // Add Larafy validators
        Validator::extend('spotifyUri', 'Rennokki\Larafy\Validators\LarafyValidator@validateUri');
        Validator::extend('spotifyUrl', 'Rennokki\Larafy\Validators\LarafyValidator@validateUrl');
    }


    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Add Larafy client to service container
        $this->app->singleton('Rennokki\Larafy\Larafy', function ($app) {
            $key = config('larafy.consumer_key');
            $secret = config('larafy.consumer_secret');

            return new Larafy($key, $secret);
        });
    }
}
