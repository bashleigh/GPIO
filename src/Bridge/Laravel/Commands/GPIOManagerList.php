<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Console\Command;

/**
 * Class GPIOManagerList
 * @package ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands
 */
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

        $this->table([
            'Name',
            'Pin',
            'Mode',
            'Method',
            'Previous Value',
            'Options',
            ], $GPIOManager->getDetailedList());
    }
}
