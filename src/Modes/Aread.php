<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

/**
 * Class Aread
 * @package ChickenTikkaMasla\GPIO\Modes
 */
class Aread extends GPIO
{
    /**
     * @param int $value
     * @return int
     */
    public function set($value = 0)
    {
        return $this->lastValue = $value;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'in';
    }
}