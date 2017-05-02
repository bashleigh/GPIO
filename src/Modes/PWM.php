<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

/**
 * Class PWM
 * @package ChickenTikkaMasla\GPIO\Modes
 */
class PWM extends GPIO
{

    public function get()
    {
        $this->getPrevious();
    }
}