<?php

namespace ChickenTikkaMasala\GPIO\Bridge\Laravel\Commands;

use ChickenTikkaMasala\GPIO\GPIOManager;
use Illuminate\Console\Command;

class GPIOManagerListen extends Command
{
    /**
     * @var string
     */
    public $signature = 'gpio:listen {name} {--onChange}';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @var null
     */
    protected $previousValue = null;

    /**
     * GPIOManagerListen constructor.
     * @param GPIOManager $GPIOManager
     */
    public function __construct(GPIOManager $GPIOManager)
    {
        $this->GPIOManager = $GPIOManager;
    }

    public function handle()
    {
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
