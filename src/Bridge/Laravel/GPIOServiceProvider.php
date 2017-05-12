<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel;

use ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands\GPIOManagerGet;
use ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands\GPIOManagerList;
use ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands\GPIOManagerListen;
use ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands\GPIOManagerSet;
use ChickenTikkaMasala\GPIO\GPIOManager;
use ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands\GPIOManagerFunction;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

/**
 * Class GPIOServiceProvider
 * @package ChickenTikkaMasala\GPIO\Bridge\Laravel
 */
class GPIOServiceProvider extends ServiceProvider
{
    const CACHE_NAME = 'GPIOManager';

    public function register()
    {
        $this->app->singleton(GPIOManager::class, function($app) {

            if (Cache::has(self::CACHE_NAME)) {
                return Cache::get(self::CACHE_NAME);
            }

            $manager = new GPIOManager(config('gpio.pins'), config('gpio.settings'));

            if(!empty(config('gpio.modes'))) {
                foreach(config('gpio.modes') as $name => $mode) {
                    $manager->registerMode($name, $mode);
                }
            }

            Cache::forever(self::CACHE_NAME, $manager);

            return $manager;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/default.php' => config_path('gpio.php'),
        ]);

        $this->commands([
            GPIOManagerGet::class,
            GPIOManagerSet::class,
            GPIOManagerFunction::class,
            GPIOManagerList::class,
            GPIOManagerListen::class,
        ]);
    }
}
