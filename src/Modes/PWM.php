<?php

namespace ChickenTikkaMasala\GPIO\Modes;

use ChickenTikkaMasala\GPIO\GPIO;

/**
 * Class PWM
 * @package ChickenTikkaMasala\GPIO\Modes
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
        return 'pwm';
    }

    public function increment($to = 1023, $interval = 200)
    {
        $i = $this->getPrevious();
        if ($i >= $to) return true;

        while($i < $to) {
            $this->set($i);
            sleep($interval);
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
            sleep($interval);
            $i--;
        }
        return true;
    }

}