<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel;

use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerFunction;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerGet;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerSet;
use ChickenTikkaMasla\GPIO\GPIOManager;

/**
 * Class GPIOServiceProvider
 * @package ChickenTikkaMasla\GPIO\Bridge\Laravel
 */
class GPIOServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GPIOManager::class, function($app) {
            return new GPIOManager(config('gpio.pins'), config('gpio.settings'));
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
            GPIOManagerFunction::class,
        ]);
    }
}
