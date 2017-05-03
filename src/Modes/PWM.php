<?php

namespace ChickenTikkaMasla\GPIO\Modes;

use ChickenTikkaMasla\GPIO\GPIO;

/**
 * Class PWM
 * @package ChickenTikkaMasla\GPIO\Modes
 */
class PWM extends GPIO
{
    /**
     *
     */
    public function get()
    {
        $this->getPrevious();
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'out';
    }

    public function increment($to = 1023, $interval = 200)
    {
        $i = $this->getPrevious();
        if ($i >= $to) return true;

        while($i < $to) {
            $this->set($i);
            delay($interval);
            $i++;
        }
        return true;
    }

    public function decrement($to = 0, $interval = 200)
    {
        $i = $this->getPrevious();
        if ($i <= $to) return true;

        while($i > $to) {
            $this->set($i);
            delay($interval);
            $i--;
        }
        return true;
    }

}