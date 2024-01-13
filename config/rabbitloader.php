<?php

return [

    // boolean - sets RabbitLoader optimization
    'active' => env('RABBIT_LOADER_ACTIVE', true),

    //boolean - if true, RL will work in me(private) mode. production ready app should have this value false
    'meMode' => env('RABBIT_LOADER_ME_MODE', false),

    //set the license key here
    'licenseKey' => env('RABBIT_LOADER_LICENSE_KEY', ''),

    //directory where cached files can be stored
    'cacheDir' => env('RABBIT_LOADER_CACHE_DIR', '/tmp/rabbitloader'),

    //skip RabbitLoader for these paths
    'skipPaths' => [],

    //skip RabbitLoader is these cookie keys are present
    'skipCookies' => [],

    //these parameters will be ignored when looking for cached data
    'ignoreParams' => [],
];
