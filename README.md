# RabbitLoader For Laravel
RabbitLoader Laravel package can be used to speed up any website that is built using Laravel framework.

# Highlights

* 🚀 Boost PageSpeed Insights Score for all pages of the Laravel website
* 🏗️ Automatically reduce image size by ~40% by converting to NextGen AVIF and WebP formats
* ➰ Lazy load below-the-fold images and YouTube videos
* 📱 Reduce CSS size by 98% automatically by generating critical-css for fastest rendering of the webpage
* ✨ Improve all Core Web Vitals metrics (lower FCP, FID, and CLS)
* ⚡️ Higher rankings on Google Search and better conversions due to page speed optimization and healthy Core Web Vitals metrics
* 🌐 Cache and serve static assets (CSS/JS/Images) via inbuilt premium CDN
* ♾️ HTTP/3 Full request and response multiplexing of static assets
* 🗜️ Use Brotli compression for static assets transfer and loading

# Installation

The package can be installed using Composer.
```bash
composer require rabbit-loader/laravel
```

## Publish configuration file
Run the below command to publish the vender assets and configurations.

```bash
php artisan vendor:publish --provider='RabbitLoader\Laravel\RLServiceProvider'
```

## Add Middleware
In the app/Http/Kernel.php file, add the RabbitLoader middleware.

```php
//app/Http/Kernel.php

protected $middleware = [
    ...
    \RabbitLoader\Laravel\Process::class
    ...
]
```

# Configuration
The configuration file can be found under the Laravel project installation directory ```config/rabbitloader.php```

Below is a sample configuration file. The configuration items are self explanatory.

```php
<?php

return [

    // boolean - sets RabbitLoader optimization
    'active' => env('RABBIT_LOADER_ACTIVE', true),

    //boolean - if true, RL will work in me(private) mode. production ready app should have this value false
    'meMode' => env('RABBIT_LOADER_ME_MODE', false),

    //set the license key here if you can not use .env file.
    'licenseKey' => env('RABBIT_LOADER_LICENSE_KEY', ''),

    //directory where cached files can be stored
    'cacheDir' => env('RABBIT_LOADER_CACHE_DIR', '/tmp'),

    //skip RabbitLoader for these paths
    'skipPaths' => ['/my-admin*', '/some-path'],

    //skip RabbitLoader is these cookie keys are present
    'skipCookies' => ['user_id'],

    //these parameters will be ignored when looking for cached data. Analytics parameters are good fit here because they do not affect the backend page structure
    'ignoreParams' => ['utm_source', 'utm_medium',],
];
```

# Config Cache
If you change configuration on environment variables, its a good idea to clear the cached content using the below command -
```bash
php artisan config:clear
```

# License Key
A license key is required to run the SDK. This guide explains [how to get the license key](https://rabbitloader.com/kb/installing-rabbitloader-on-a-laravel-website/).
After getting the license key, you can keep it in the ```.env``` file
```env
RABBIT_LOADER_LICENSE_KEY='license key goes here'
``` 

# Support
[Contact RabbitLoader team here](https://rabbitloader.local/contact/).