<?php

namespace Rennokki\Larafy\Test;

use Rennokki\Larafy\Larafy;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected $api;

    public function setUp()
    {
        parent::setUp();

        sleep(1);

        $this->api = new Larafy(getenv('SPOTIFY_CLIENT_ID'), getenv('SPOTIFY_SECRET'));
    }

    protected function getPackageProviders($app)
    {
        return [
            \Rennokki\Larafy\LarafyServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
    }
}
