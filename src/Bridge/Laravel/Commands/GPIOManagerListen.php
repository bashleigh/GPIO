<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Console\Command;

/**
 * Class GPIOManagerListen
 * @package ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands
 */
class GPIOManagerListen extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpio:listen {name} {--onChange}';

    /**
     * @var string
     */
    public $description = 'Listen to a particular pin';

    /**
     * @var null
     */
    protected $previousValue = null;

    /**
     * @var GPIOManager
     */
    private $GPIOManager;


    public function handle(GPIOManager $GPIOManager)
    {
        $this->GPIOManager = $GPIOManager;
        ($this->getOption('onChange')) ? $this->onChange() : $this->consistent();
    }

    public function consistent()
    {
        while(true)
        {
            $this->info($this->GPIOManager->{$this->getArgument('name')});
        }
    }

    public function onChange()
    {
        while (true)
        {
            $value = $this->GPIOManager->{$this->getArgument('name')};

            if ($value !== $this->previousValue) $this->info($value);

            else $this->previousValue = $value;

        }
    }
}
