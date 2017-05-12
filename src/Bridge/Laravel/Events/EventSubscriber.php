<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Events;

use ChickenTikkaMasala\GPIO\Bridge\Laravel\GPIOServiceProvider;
use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Cache;
use Illuminate\Events\Dispatcher;

/**
 * Class EventSubscriber
 * @package ChickenTikkaMasala\GPIO\Bridge\Laravel\Events
 */
class EventSubscriber
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Foundation\Http\Events\RequestHandled',
            get_class($this).'@updateCache'
        );
    }

    /**
     * @param GPIOManager $GPIOManager
     * @return mixed
     */
    public function updateCache(RequestHandled $requestHandled)
    {
        dd($requestHandled);

        dd('hi');
        Cache::forever(GPIOServiceProvider::CACHE_NAME, $GPIOManager);
    }
}
