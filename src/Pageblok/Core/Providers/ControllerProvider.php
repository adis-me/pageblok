<?php

namespace Pageblok\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Pageblok\CMS\Controllers\DashboardController;
use Pageblok\Navigation\Controllers\NavigationController;
use Pageblok\Settings\Controllers\SettingsController;

class ControllerProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // KEEP THEM ALPHABETICALLY!!!

        // D
        $this->app->bind(
            'DashboardController',
            function () {
                return new DashboardController();
            }
        );

        // N
        $this->app->bind(
            'NavigationController',
            function ($app) {
                return new NavigationController(
                    $app->make('NavigationRepository')
                );
            }
        );

        // S
        $this->app->bind(
            'SettingsController',
            function ($app) {
                return new SettingsController(
                    $app->make('SettingRepository')
                );
            }
        );
    }
}