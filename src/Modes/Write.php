<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

class Write extends GPIO
{
    public function set($value = 0)
    {
        $this->lastValue = (int)($value >1) ? 1: (($value <1) ? 0 : $value);
        $this->write();
    }

    public function get()
    {
        $this->getPrevious();
    }
}