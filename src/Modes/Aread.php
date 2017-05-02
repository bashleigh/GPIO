<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

class Aread extends GPIO
{
    public function set($value = 0)
    {
        return $this->lastValue = $value;
    }
}