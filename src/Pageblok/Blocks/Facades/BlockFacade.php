<?php


namespace Pageblok\Blocks\Facades;


use Illuminate\Support\Facades\Facade;
use Pageblok\Blocks\Services\Block;

class BlockFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "block";
    }
} 