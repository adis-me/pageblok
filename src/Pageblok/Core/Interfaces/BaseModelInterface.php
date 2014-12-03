<?php


namespace Pageblok\Core\Interfaces;


/**
 * interface IBaseModel
 * @package Pageblok\Core\Interfaces
 */
interface BaseModelInterface
{
    /**
     * Get the entity name for this model
     * @return string
     */
    public function getModelName();

    /**
     * Get the plural model name
     * @return mixed
     */
    public function getPluralModelName();

    /**
     * Get default page size for this model.
     * @return int Default 20
     */
    public function getPageSize();

} 