<?php


namespace Pageblok\Navigation;

use Illuminate\Support\ServiceProvider;
use Pageblok\Navigation\Services\Navigation;


/**
 * Class NavigationServiceProvider
 * @package Pageblok\Navigation
 */
class NavigationServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'navigation',
            function () {
                return new Navigation(\App::make('NavigationRepository'));
            }
        );
    }
}