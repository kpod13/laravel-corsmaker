<?php

namespace Kpod13\CorsMaker;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Http\Kernel;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/config/corsmaker.php' => config_path('corsmaker.php'),
        ]);

        $kernel = $this->app->make(Kernel::class);

        if (! $kernel->hasMiddleware(CorsMakerHandler::class)) {
            $kernel->prependMiddleware(CorsMakerHandler::class);
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CorsMakerService::class, function ($app) {
            return new CorsMakerService(config('corsmaker'));
        });
    }
}