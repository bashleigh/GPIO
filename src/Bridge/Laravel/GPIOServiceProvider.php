<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel;

use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerGet;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerSet;
use ChickenTikkaMasla\GPIO\GPIOManager;

class RiakServiceProvider extends ServiceProvider

/**
 * Class GPIOServiceProvider
 * @package ChickenTikkaMasla\GPIO\Bridge\Laravel
 */
class GPIOServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GPIOManager::class, function($app) {
            return new GPIOManager(config('gpio'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'config/default.php' => config_path('gpio.php'),
        ]);

        $this->commands([
            GPIOManagerGet::class,
            GPIOManagerSet::class,
        ]);
    }
}