<?php

namespace EmilMoe\Extendable;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ExtendableServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }
}
