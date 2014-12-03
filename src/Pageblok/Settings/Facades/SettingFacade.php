<?php


namespace Pageblok\Settings\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * Class SettingFacade
 * @package Pageblok\Settings\Facades
 * @author Adis Corovic <adis@live.nl>
 */
class SettingFacade extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return "settings";
    }
} 