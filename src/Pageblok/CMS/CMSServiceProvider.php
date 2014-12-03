<?php

namespace Pageblok\CMS;

use Illuminate\Support\ServiceProvider;
use Pageblok\CMS\Controllers\AssetController;
use Pageblok\CMS\Controllers\CMSController;

/**
 * Class CMSServiceProvider
 */
class CMSServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CMSController',
            function ($app) {
                return new CMSController(
                    $app->make('PageRepository')
                );
            }
        );

        $this->app->bind(
            'AssetController',
            function ($app) {
                return new AssetController();
            }
        );
    }
}