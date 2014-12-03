<?php


namespace Pageblok\Navigation\Repositories;

use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Navigation\Interfaces\NavigationRepositoryInterface;


/**
 * Class NavigationRepository
 * @package Pageblok\Navigation\Repositories
 */
class NavigationRepository extends BaseRepository implements NavigationRepositoryInterface
{

    public function all()
    {
        return $this->model->with('children')->get();
    }
} 