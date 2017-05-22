# GPIO manager

> requires testing

The GPIO manager is designed to house your hardware environment setup and allow you to manager and interact with the hardware. 

The GPIO manager comes with a Laravel bridged service provider for easy integration with Laravel.

The GPIO class requires gpio to be installed 

```bash
apt-get install gpio
```

Installing into laravel 

```php
'providers' => [

    ...
    
    \ChickenTikkaMasala\GPIO\Bridge\Laravel\GPIOServiceProvider::class,
    
    ...
    
];
```

Add the event listener to your Event Service Provider 

```php
$subscribe = [
    \ChickenTikkaMasala\GPIO\Bridge\Laravel\Events\EventSubscriber::class,
];
```
The above is for recaching the GPIO manager after a request to prevent redeclaration of the manager and resetting everything to their default value

Publish the vendor to get the config files

```bash
php artisan vendor:publish --provider="ChickenTikkaMasala\GPIO\Bridge\Laravel\GPIOServiceProvider"
```
Example setup
```php
    'pins' => [
        'redled' => [
            'pin' => 1,
            'mode' => 'pwm',
        ],
    ],
```
### Testing with the command line 

Turn the redled on pin 1 on full

```bash
php artisan gpio:set redled 1023
```
List all GPIO pin input from your setup
```bash
php artisan gpio:list
```
This will output an array of all the GPIOs setup with the manager

### Creating a new connection

Alternatively to config setup you can call the create function to add new connections. 

```php
    public function index(GPIOManager $manager) 
    {
        $manager->create('greenled', 2);
        $manager->greenled = 'ON';
    }
```

The manager maps your named connections as parameters as shown above. When reading pins we can use the same method with the parameters to get the result 

```php
    public function index(GPIOManager $manager)
    {
        //create an analog sensor
        $manager->create('sensor', 3, 'aread');
        $value = $manager->sensor;
        
        return response()->json(['sensor' => $value]);
    }
```

Mapping also applies to the values 'OFF' and 'ON' where PWM expects 1023 as max and write expect 1. 'OFF' will equal to 0.

### Custom GPIO Classes/Modes

You can however add your own GPIO modes/classes in 2 ways. 

First being 

```php

use ChickenTikkaMasala\GPIO\GPIO;

class RedLED extends GPIO
{
    public function __construct()
    {
        parent::__construct(1, 'pwm', 'OFF');
    }
    
    public function getMethod()
    {
        return 'out';
    }
    
}
```

```php
    public function index(GPIOManager $manager)
    {
        $redLED = new RedLED();
        $manager->add($redLED);
    }
```

Another method is to use the registerMode function to register the mode type for the manager so you can do something like this

```php
    $manager->create('red', 1, 'LED');
```
Our GPIO config array in app/gpio.php
```php
    'modes' => [
        'LED' => \App\GPIO\Modes\LED::class,
    ],
```

### Terminal functions

- `gpio:set redled 500` => set red LED to 500
- `gpio:get sensor` => print the sensor reading
- `gpio:list` => list all connections
- `gpio:function redled increment 1023 1000` => call the increment function with the options (options needs implementing)
- `gpio:listen sensor --onChange` => prints the state of the sensor (onChange option to only print if value has changed else consistently print incoming value)

## Available default modes 

- PWM => for incrementing the voltage between 0 and max
- Awrite
- ARead
- Write => for writing to pins either OFF or ON (0v or max voltage)
- Read => for reading pins either OFF or ON 

## Value conversions 

You may remember seeing (if you've ever used an arduino) values being set as HIGH or LOW. You can do this with the GPIO and depending on it's mode it will automatically fix your maximum value. 

```php
    //PWM all the below = 1023
    $manager->redled = 'HIGH';
    $manager->redled = 'UP';
    $manager->redled = 'ON';
    
    //Where as for write and awrite: these equal to 1
    $manager->redled = 'HIGH';
    $manager->redled = 'UP';
    $manager->redled = 'ON';
    //all equal to 1
    
    //The below all equal to 0
    $manager->redled = 'LOW';
    $manager->redled = 'DOWN'
    $manager->redled = 'OFF';
```

## Getting the GPIO class out of the manager

You can get the class out of the manager if you wish using 

```php
    $redled = $manager->get('redled');
    
    //if you wanted to put it back simply use the add function again
    
    $manager->add('redled', $redled);
```


### PWM functions

In PWM GPIO I have added 2 function for incrementing and decrementing for incrementing/decrementing to a value within an interval.
```php
$redled = $manager->get('redled');
$redled->increment(1023, 200);
//redled will 'fade' from 0 to 1023 
//increment will increase every 200th millisecond

$redled->decrement(0, 200);

$manager->add('redled', $redled);
```

### GPIO Options 
If you see http://wiringpi.com/the-gpio-utility/ there is a usage section. These options are available to pass to the GPIOManager like so (example to use BCM pins):

```php
    'pins' => [
        'redled' => [
            'pin' => 18, //wiring pi pin 1 = BCM pin 18
            'mode' => 'pwm',
            'options' => [
                '-g',
            ],
        ],
    ],
```

An extremely hand pin map https://pinout.xyz/

# Coming soon

- Symfony bridge
- mapping values from 'low' to 'high' (for ESCs for example a pwm value of 60 is 0. For servos we may want to map 0 - 1023 to something like 0 - 180 degrees where a 'high' of 1023 = 180 degrees)
- exceptions for command errors
