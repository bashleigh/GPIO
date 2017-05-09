<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Console\Command;

/**
 * Class GPIOManagerSet
 * @package ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands
 */
class GPIOManagerSet extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpio:set {name} {value}';

    /**
     * @var string
     */
    public $description = 'Set a particular parameter with a value';

    /**
     * @param GPIOManager $GPIOManager
     */
    public function handle(GPIOManager $GPIOManager)
    {
        $GPIOManager->{$this->argument('name')} = $this->argument('value');
    }
}
