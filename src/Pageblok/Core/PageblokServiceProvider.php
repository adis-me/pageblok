<?php

namespace Pageblok\Core;

use Illuminate\Support\ServiceProvider;
use Pageblok\Core\Services\BackendMenu;

class PageblokServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package("adis-me/pageblok", null, __DIR__ . '/../../');
        $this->registerPackageRoutes();
        $this->setThemeFolder();
    }

    /**
     * Register the service provider and other service providers that we need.
     *
     * @return void
     */
    public function register()
    {
        // Our own service providers
        $this->app->register('Pageblok\Core\Providers\RepositoryProvider');
        $this->app->register('Pageblok\Core\Providers\ControllerProvider');
        $this->app->register('Pageblok\Navigation\NavigationServiceProvider');
        $this->app->register('Pageblok\Settings\SettingServiceProvider');
        $this->app->register('Pageblok\Pages\PageServiceProvider');
        $this->app->register('Pageblok\Blocks\BlockServiceProvider');
        $this->app->register('Pageblok\CMS\CMSServiceProvider');
        // third party service providers
        $this->app->register('Intervention\Image\ImageServiceProvider');
        $this->app->register('Toin0u\Geocoder\GeocoderServiceProvider');
        $this->app->register('Krucas\Notification\NotificationServiceProvider');


        $this->registerFacades();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * Register package routes.
     * Include routes from our sub packages.
     */
    private function registerPackageRoutes()
    {
        include __DIR__ . "/../../routes.php";
        include __DIR__ . "/../Pages/routes.php";
        include __DIR__ . "/../Blocks/routes.php";
    }

    /**
     * Set custom view folder, user themes are located in the root
     */
    private function setThemeFolder()
    {

        \View::addNamespace('pageblok', app('path') . '/../themes');
        //\View::addLocation(app('path') . '/../themes');
    }

    /**
     * Register facades
     */
    private function registerFacades()
    {
        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();

                // our own Facades
                $loader->alias('Pageblok', 'Pageblok\Core\Facades\PageblokFacade');
                $loader->alias('Navigation', 'Pageblok\Navigation\Facades\NavigationFacade');
                $loader->alias('Setting', 'Pageblok\Settings\Facades\SettingFacade');
                $loader->alias('Page', 'Pageblok\Pages\Facades\PageFacade');
                $loader->alias('Block', 'Pageblok\Blocks\Facades\BlockFacade');
                // third party Facades
                $loader->alias('Notification', 'Krucas\Notification\Facades\Notification');
                $loader->alias('Image', 'Intervention\Image\Facades\Image');
                $loader->alias('Carbon', 'Carbon\Carbon');
                $loader->alias('Geocoder', 'Toin0u\Geocoder\GeocoderFacade');
            }
        );
    }
}
