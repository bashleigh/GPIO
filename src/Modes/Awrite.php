<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

/**
 * Class Awrite
 * @package ChickenTikkaMasla\GPIO\Modes
 */
class Awrite extends GPIO
{
    /**
     * @param int $value
     * @return int
     */
    public function set($value = 0)
    {
        $this->lastValue = $value;
        return $value;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'out';
    }
}