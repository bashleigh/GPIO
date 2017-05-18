<?php

namespace ChickenTikkaMasala\GPIO\Modes;

use ChickenTikkaMasala\GPIO\GPIO;

/**
 * Class Write
 * @package ChickenTikkaMasala\GPIO\Modes
 */
class Write extends GPIO
{
    public static $max = 1;

    /**
     * @return int
     */
    public function get()
    {
        return $this->getPrevious();
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'out';
    }
}
