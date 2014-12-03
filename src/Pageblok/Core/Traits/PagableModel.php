<?php


namespace Pageblok\Core\Traits;


/**
 * Class PagableModel
 * @package Pageblok\Core\Traits
 */
trait PagableModel
{

    /**
     * @inheritdoc
     */
    public function getPageSize()
    {
        return 20;
    }
} 