<?php


namespace Pageblok\Navigation\Services;

use Pageblok\Navigation\Interfaces\NavigationRepositoryInterface;


/**
 * Class Navigation
 * @package Pageblok\Navigation\Services
 */
class Navigation
{
    protected $repository;

    /**
     * Cached menu items
     * @var
     */
    protected $menuBag;

    /**
     * Default constructor
     * @param NavigationRepositoryInterface $repository
     */
    public function __construct(NavigationRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->loadFromRepository();
    }

    /**
     * Load menu items from the repository
     */
    private function loadFromRepository()
    {
        $this->repository->all()->each(
            function ($menu) {
                if (is_null($menu->parent_id)) {
                    $this->menuBag[$menu->id] = $menu;
                }
            }
        );
    }

    public function hasItems()
    {
        return sizeof($this->menuBag) > 0;
    }

    /**
     * Return array with menu items
     * @return mixed
     */
    public function items()
    {
        return $this->menuBag;
    }
} 