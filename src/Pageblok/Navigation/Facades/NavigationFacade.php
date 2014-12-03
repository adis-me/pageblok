<?php


namespace Pageblok\Navigation\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * Class NavigationFacade
 * @package Pageblok\Navigation\Facades
 */
class NavigationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "navigation";

    }

} 