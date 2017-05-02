<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

class Read extends GPIO
{
    public function set($value = 0)
    {
        return $this->lastValue = (int)($value >1) ? 1: (($value <1) ? 0 : $value);
    }
}