<?php

return [

    /*
    |--------------------------------------------------------------------------
    | GPIO Manager environment setup
    |--------------------------------------------------------------------------
    |
    | Here you can add your array which is used to be setup by the GPIO Manager.
    | These will be your default environment pin setup for GPIO management.
    | Values here can be alter later on in your project
    | See example below
    */

    'settings' => [
        //default mode for pins when mode is undefined

//        'default_mode' => 'pwm',

    ],

    /*
     * modes to be registered with GPIO manager on boot
     */
    'modes' => [

//        'LED' => \App\GPIO\Modes\LED::class,

    ],

    /**
     * GPIO hardware environment setup
     */
    'pins' => [

//        'redled' => [
//            'pin' => 1,
//            'mode' => 'write',
//            'defaultValue' => 0,
//        ],

    ],

];
