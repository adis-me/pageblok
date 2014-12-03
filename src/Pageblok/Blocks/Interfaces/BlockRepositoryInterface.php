<?php


namespace Pageblok\Blocks\Interfaces;


use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface BlockRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get block by its unique name
     *
     * @param string $name
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByName($name);


    /**
     * Get blocks by a group
     *
     * @param $groupName
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByGroup($groupName);

    /**
     * Get groups used by blocks
     *
     * @return Array|null Can be null or array with blocks
     */
    public function getGroups();
} 