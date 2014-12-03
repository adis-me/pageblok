<?php


namespace Pageblok\Blocks\Repositories;


use Illuminate\Support\Facades\DB;
use Pageblok\Blocks\Interfaces\BlockRepositoryInterface;
use Pageblok\Blocks\Interfaces\Illuminate\Database\Eloquent\Collection;
use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Pageblok\Interfaces\Illuminate;

class BlockRepository extends BaseRepository implements BlockRepositoryInterface
{


    /**
     * Get block by its unique name
     *
     * @param string $name
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByName($name)
    {
        return $this->model->where('pb_name', $name)->first();
    }


    /**
     * Get blocks by a group
     *
     * @param $groupName
     * @param bool $includedUnpublished
     * @return Collection
     */
    public function getByGroup($groupName, $includedUnpublished = true)
    {
        if ( ! $includedUnpublished ) {
            return $this->model->where('group', $groupName)->where('published', false)->paginate($this->model->getPageSize());
        }
        return $this->model->where('group', $groupName)->paginate($this->model->getPageSize());
    }

    /**
     * Get groups used by blocks
     *
     * @return Array|null Can be null or array with blocks
     */
    public function getGroups()
    {
        $groupResult = \DB::table('blocks')->lists('group');

        return array_filter(array_unique($groupResult));
    }
}