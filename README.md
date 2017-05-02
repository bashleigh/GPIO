#GPIO manager

A manager for GPIO pins. 

Using this manager should be easy! 

```
$manager = new ChickenTikkaMasala\GPIO\GPIOManager();
$manager->create('redlight', 20, 'ON');

delay(2000);

$manager->redlight = 'OFF';

delay(2000);

$manager->redlight = 'ON';

```

You can even add your own GPIO class if you wish

```
$manager->add('redlight', new RedLightGPIO(20, 'OFF'));

```

Where class RedLight extends GPIO.


Fading 
```
$i=0;
while($i < 1023) {
    $manager->redlight = $i;
    $i++;
    delay(2000);
}
```

Reading pins 

```$xslt
$manager->create('signal', 18);
$int = $manager->signal;
var_dump($int);//Int is the signal of the pin
```

environment setup in one easy sweep 

```$xslt
$manager = new ChickenTikkaMasla\GPIO\GPIOManager([
    "redlight" => [
        "pin" => 20,
        "defaulValue" => "ON",
    ],
    "signal" => [
        "pin" => 18,
    ],
]);
```
Helpful when using laravel or symfony. Bridging will allow you to either add this as a service or a provider