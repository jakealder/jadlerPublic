<?php

namespace App\Providers;

use App\Api\ApiManager;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('api', function ($app) {
            return new ApiManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['api'];
    }
}
