<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasla\GPIO\GPIOManager;
use Illuminate\Console\Command;

/**
 * Class GPIOManagerSet
 * @package ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands
 */
class GPIOManagerSet extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpiomanager:set {name} {value}';

    /**
     * @var string
     */
    public $description = '';

    /**
     *
     */
    public function handle(GPIOManager $GPIOManager)
    {
        $GPIOManager->{$this->argument('name')} = $this->argument('value');
    }
}