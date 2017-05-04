<?php

namespace ChickenTikkaMasala\GPIO;

/**
 * Class GPIO
 * @package ChickenTikkaMasala\GPIO
 */
Abstract class GPIO
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
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    private $availableOptions = [
        'g',
        '1',
        'p',
        'x',
    ];

    /**
     * @var string
     */
    private $mode = '';

    /**
     * @var string
     */
    private $method = '';

    /**
     * GPIO constructor.
     * @param $pin
     * @param string $defaultState
     * @param array $options
     */
    public function __construct($pin, $defaultState = 'OFF', $options = [])
    {
        $this->pin = $pin;
        $this->mode = $this->getMode();
        $this->method = $this->getMethod();
        $this->setOptions($options);
        $this->executeMode();
        $this->set($defaultState);
    }

    /**
     * @param $options
     */
    protected function setOptions(Array $options = [])
    {
        foreach($options as $option)
        {
            if (in_array($option, $this->availableOptions)) {
                $this->options[] = '-'.$option;
            }
        }
    }

    /**
     * @return string
     */
    protected function getMode()
    {
        return get_class($this);
    }

    abstract public function getMethod();

    /**
     * @return int
     */
    public function getPrevious()
    {
        return $this->lastValue;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->lastValue = $this->execute(true);
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
     * @param bool $read
     * @return string
     */
    protected function execute($read = false)
    {
        return shell_exec('gpio '.$this->mode.'  '.$this->pin.' '.($read) ? '' : $this->lastValue);
    }

    /**
     * @return string
     */
    protected function executeMode()
    {
        return shell_exec('gpio '.implode(' ', $this->options).' mode '.$this->pin.' '.$this->method);
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
