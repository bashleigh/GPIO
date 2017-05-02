<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

class Awrite extends GPIO
{
    public function set($value = 0)
    {
        $this->lastValue = $value;
        return $value;
    }
}