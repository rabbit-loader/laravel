<?php

namespace RabbitLoader\Laravel;

use Illuminate\Support\ServiceProvider;

class RLServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/rabbitloader.php' => config_path('rabbitloader.php'),
        ]);
    }

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rabbitloader.php', 'rabbitloader.php');
    }
}
