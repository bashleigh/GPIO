<?php

namespace ChickenTikkaMasla\GPIO;
use ChickenTikkaMasla\GPIO\Exception\GPIOModeNotFound;
use ChickenTikkaMasla\GPIO\Modes\Aread;
use ChickenTikkaMasla\GPIO\Modes\Awrite;
use ChickenTikkaMasla\GPIO\Modes\PWM;
use ChickenTikkaMasla\GPIO\Modes\Read;
use ChickenTikkaMasla\GPIO\Modes\Write;

/**
 * Class PWMManager
 * @package ChickenTikkaMasla\GPIO
 */
class GPIOManager
{
    /**
     * @var array
     */
    public $pins = [];

    /**
     * @var array
     */
    private $modes = [
        'aread' => Aread::class,
        'awrite' => Awrite::class,
        'pwm' => PWM::class,
        'read' => Read::class,
        'write' => Write::class,
    ];

    public $options = [
        'default_mode' => 'awrite',
    ];

    /**
     * GPIOManager constructor.
     * @param array $pins
     * @throws \Exception
     */
    public function __construct(Array $pins = [], Array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        foreach($pins as $name => $data)
        {
            if (!isset($data['pin'])) {
                throw new \Exception('Please add a pin for '.$name);
            }

            call_user_func_array([$this, 'create'], [$data]);
        }
    }

    /**
     * @param $name
     * @param GPIO $mode
     */
    public function registermode($name, GPIO $mode)
    {
        $this->modes[$name] = $mode;
    }

    /**
     * @param $name
     * @return bool
     */
    public function exists($name)
    {
        return in_array($name, array_keys($this->pins));
    }

    /**
     * @param $name
     * @param $pin
     * @param null $mode
     * @param string $defaultState
     * @param array $options
     * @throws GPIOModeNotFound
     */
    public function create($name, $pin, $mode = null, $defaultState = 'OFF', Array $options = [])
    {

        $mode = $mode !== null ? $mode : $this->options['default_mode'];

        if (!in_array($mode, array_keys($this->modes))) {
            throw new GPIOModeNotFound($name);
        }
        $this->add($name, new $this->modes[$mode]($pin, $defaultState, $options));
    }

    public function add($name, GPIO $gpio)
    {
        $this->pins[$name] = $gpio;
    }

    /**
     * @param $name
     */
    public function destroy($name)
    {
        if ($this->exists($name))
        {
            unset($this->pins[$name]);
        }
    }

    /**
     * @param $parameter
     * @return null
     */
    public function __get($parameter)
    {
        if ($this->exists($parameter)) {
            return $this->pins[$parameter]->get();
        } else return null;
    }

    /**
     * @param $parameter
     * @param $value
     * @return mixed
     */
    public function __set($parameter, $value)
    {
        if ($this->exists($parameter)) {
            return $this->pins[$parameter]->set($value);
        }
        else return $value;
    }

    public function __destruct()
    {
        foreach($this->pins as $pin) {
            $pin->__destruct();
        }
    }

    /**
     * @return array
     */
    public function getList()
    {
        $arr = [];

        foreach($this->pins as $name => $gpio)
        {
            $arr[$name] = $gpio->getPrevious();
        }

        return $arr;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->getList());
    }
}
