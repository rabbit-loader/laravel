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

        \Illuminate\Support\Facades\Route::middleware('web')->get(
            '/rl-csrf-token',
            function (\Illuminate\Http\Request $request) {
                $token = $request->session()->token();
                if (!$token) {
                    $token = csrf_token();
                }
                return ['csrf_token' => $token];
            }
        )->name('rl.csrf-token');
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
