<?php

namespace ChickenTikkaMasla\PWM;

/**
 * Class PWMManager
 * @package ChickenTikkaMasla\PWM
 */
class PWMManager
{
    /**
     * @var array
     */
    public $pins = [];

    /**
     * PWMManager constructor.
     * @param array $pins
     */
    public function __construct($pins = [])
    {
        foreach($pins as $name => $data)
        {
            //could use user_func_array
            if (!isset($data['pin'])) {
                throw new \Exception('Please add a pin for '.$name);
            }

            $this->create($name, $data['pin'], isset($data['defaultState']) ? $data['defaultState'] : 'OFF', isset($data['g']) ? $data['g'] : false);
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
        $this->pin[$name] = new PWM($pin, $defaultState);
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
