<?php

namespace ChickenTikkaMasala\GPIO\Modes;

use ChickenTikkaMasala\GPIO\GPIO;

/**
 * Class Aread
 * @package ChickenTikkaMasala\GPIO\Modes
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