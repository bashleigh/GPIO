<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Console\Command;

class GPIOManagerList extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpio:list';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @param GPIOManager $GPIOManager
     */
    public function handle(GPIOManager $GPIOManager)
    {
        foreach($GPIOManager->getList() as $name => $value) {
            $this->info($name.': '.$value);
        }
    }
}
