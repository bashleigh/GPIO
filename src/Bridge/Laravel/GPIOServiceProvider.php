<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel;

use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerFunction;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerGet;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerList;
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

            $manager = new GPIOManager(config('gpio.pins'), config('gpio.settings'));

            if(!empty(config('gpio.modes'))) {
                foreach(config('gpio.modes') as $name => $mode) {
                    $manager->registerMode($name, $mode);
                }
            }

            return $manager;
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
            GPIOManagerList::class,
        ]);
    }
}
