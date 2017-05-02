<?php

namespace ChickenTikkaMasla\PWM;

/**
 * Class PWM
 * @package ChickenTikkaMasla\PWM
 */
class PWM
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

    /**
     * PWM constructor.
     * @param $pin
     * @param string $defaultState
     */
    public function __construct($pin, $defaultState = 'OFF')
    {
        $this->pin = $pin;
        $this->set($defaultState);
    }

    /**
     * @return int
     */
    public function get()
    {
        return $this->lastValue;
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
        return $this->execute();
    }

    /**
     * @return string
     */
    private function execute()
    {
        return shell_exec('');
    }

}
