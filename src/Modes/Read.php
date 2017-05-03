<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

/**
 * Class Read
 * @package ChickenTikkaMasla\GPIO\Modes
 */
class Read extends GPIO
{
    /**
     * @param int $value
     * @return int
     */
    public function set($value = 0)
    {
        return $this->lastValue = (int)($value >1) ? 1: (($value <1) ? 0 : $value);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'in';
    }
}