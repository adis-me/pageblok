<?php


namespace Pageblok\Pages\Repositories;

use Illuminate\Support\Collection;
use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Pages\Interfaces\PageRepositoryInterface;


/**
 * Class PageRepository
 * @package Pageblok\Pages\Repositories
 * @author Adis Corovic <adis@live.nl>
 */
class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    /**
     * Find model by slug
     *
     * @param string $slug
     * @return Collection
     */
    public function findBySlug($slug)
    {
        return $this->model->where('pb_name', urldecode($slug))->first();
    }
}