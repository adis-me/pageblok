<?php


namespace Pageblok\Core\Facades;


use Illuminate\Support\Facades\Facade;


/**
 * Class PageblokFacade
 * @package Pageblok\Core\Facades
 */
class PageblokFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('Pageblok\Core\Services\Pageblok');
    }
} 