<?php

namespace ChickenTikkaMasla\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasla\GPIO\GPIOManager;
use Illuminate\Console\Command;

class GPIOManagerList extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpiomanager:list';

    /**
     * @var string
     */
    public $description = '';

    /**
     *
     */
    public function handle(GPIOManager $GPIOManager)
    {
        $this->info($GPIOManager->getList());
    }
}