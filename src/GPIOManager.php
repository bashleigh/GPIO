<?php

namespace ChickenTikkaMasla\GPIO;

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
     * GPIOManager constructor.
     * @param array $pins
     * @throws \Exception
     */
    public function __construct($pins = [])
    {
        foreach($pins as $name => $data)
        {
            //could use user_func_array
            if (!isset($data['pin'])) {
                throw new \Exception('Please add a pin for '.$name);
            }

            call_user_func_array([$this, 'create'], [$data]);
        }
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
     * @param string $defaultState
     */
    public function create($name, $pin, $defaultState = 'OFF')
    {
        $this->add($name, new GPIO($pin, $defaultState));
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
    }

    public function __destruct()
    {
        foreach($this->pins as $pin) {
            $pin->__destruct();
        }
    }
}
