<?php

namespace ChickenTikkaMasala\GPIO\Modes;

use ChickenTikkaMasala\GPIO\GPIO;

/**
 * Class Awrite
 * @package ChickenTikkaMasala\GPIO\Modes
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