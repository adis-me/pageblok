<?php


namespace Pageblok\Pages;


use Illuminate\Support\ServiceProvider;
use Pageblok\Pages\Controllers\PageController;
use Pageblok\Pages\Repositories\PageRepository;

class PageServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'PageRepository',
            function () {
                return new PageRepository(new \Pageblok\Pages\Models\Page());
            }
        );

        $this->app->bind(
            'PageController',
            function ($app) {
                return new PageController(
                    $app->make('PageRepository')
                );
            }
        );

        $this->app->singleton(
            'page',
            function () {
                return new \Pageblok\Pages\Services\Page(\App::make('PageRepository'));
            }
        );
    }

} 