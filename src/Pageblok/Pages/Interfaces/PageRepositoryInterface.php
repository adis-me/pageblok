<?php

namespace Pageblok\Pages\Interfaces;

use Illuminate\Support\Collection;
use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface PageRepositoryInterface extends BaseRepositoryInterface
{


    /**
     * Find model by slug
     *
     * @param string $slug
     * @return Collection
     */
    public function findBySlug($slug);

}