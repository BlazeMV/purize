<?php

namespace Blaze\Spyke\Support\Laravel;

use Blaze\Purize\Laravel\SanitizerFactory;
use Illuminate\Support\ServiceProvider;

class PurizeServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
    
    }
    
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('sanitizer', function () {
            return new SanitizerFactory();
        });
    }
}
