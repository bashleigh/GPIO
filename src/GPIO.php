<?php

namespace ChickenTikkaMasla\GPIO;

/**
 * Class GPIO
 * @package ChickenTikkaMasla\GPIO
 */
class GPIO
{
    /**
     * @var int
     */
    private $pin = 0;

    /**
     * @var int
     */
    protected $lastValue = 0;

    /**
     * @var int
     */
    protected static $max = 1023;

    private $g = '-1';

    /**
     * PWM constructor.
     * @param $pin
     * @param string $defaultState
     */
    public function __construct($pin, $defaultState = 'OFF', $g = false)
    {
        $this->g = ($g) ? '-g' : '-1';
        $this->pin = $pin;
        $this->executeMode();
        $this->set($defaultState);
    }

    /**
     * @return int
     */
    public function getPrevious()
    {
        return $this->lastValue;
    }

    public function get()
    {
        return $this->lastValue = $this->read();
    }

    /**
     * @param int $value
     * @return string
     */
    public function set($value = 0)
    {
        if (strtoupper($value) == 'ON') $value = self::$max;
        if (strtoupper($value) == 'OFF') $value = 0;

        $this->lastValue = $value;
        return $this->write();
    }

    /**
     * @return string
     */
    private function write()
    {
        return shell_exec('gpio '.$this->g.' pwm '.$this->pin.' '.$this->lastValue);
    }

    /**
     * @return string
     */
    private function read()
    {
        return shell_exec('gpio read '.$this->pin);
    }

    /**
     * @return string
     */
    private function executeMode()
    {
        return shell_exec('gpio '.$this->g.' mode '.$this->pin.' pwm');
    }

    public function __destruct()
    {
        $this->set();
    }

    public function __toString()
    {
        return (string)$this->lastValue;
    }

}
