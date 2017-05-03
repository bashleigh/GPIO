<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasla\GPIO\GPIOManager;
use Illuminate\Console\Command;

/**
 * Class GPIOManagerGet
 * @package ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands
 */
class GPIOManagerGet extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpiomanager:get {name}';

    /**
     * @var string
     */
    public $description = '';

    /**
     *
     */
    public function handle(GPIOManager $GPIOManager)
    {
        $this->info($GPIOManager->{$this->argument('name')});
    }
}