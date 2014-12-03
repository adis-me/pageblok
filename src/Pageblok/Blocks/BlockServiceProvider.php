<?php


namespace Pageblok\Blocks;


use Illuminate\Support\ServiceProvider;
use Pageblok\Blocks\Controllers\BlockController;
use Pageblok\Blocks\Models\Block;
use Pageblok\Blocks\Repositories\BlockRepository;
use Pageblok\Blocks\Services\Block as BlockFacade;

/**
 * Class BlockServiceProvider
 *
 * @package Pageblok\Blocks
 * @author  Adis Corovic <adis@live.nl>
 */
class BlockServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'BlockRepository',
            function () {
                return new BlockRepository(new Block());
            }
        );

        $this->app->bind(
            'BlockController',
            function ($app) {
                return new BlockController(
                    $app->make('BlockRepository')
                );
            }
        );

        $this->app->singleton(
            'block',
            function () {
                return new BlockFacade(\App::make('BlockRepository'));
            }
        );
    }

} 