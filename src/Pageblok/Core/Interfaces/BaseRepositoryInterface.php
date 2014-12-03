<?php


namespace Pageblok\Core\Interfaces;


/**
 * Base repository interface
 *
 * @package Pageblok\Core\Interfaces
 */
interface BaseRepositoryInterface
{
    /**
     * Construct a new model to use within this repository.
     * @param BaseModelInterface $model
     */
    public function __construct(BaseModelInterface $model);

    /**
     * Get all models from this repository.
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get all models paginated from the repository.
     * @return mixed
     */
    public function allPaged();

    /**
     * Get model with id from repository.
     * @param $id int
     * @return mixed|null
     */
    public function findById($id);

    /**
     * Create a model instance to the repository.
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * Update current model in the repository.
     * @param $id
     * @param $data
     * @return bool|int
     */
    public function update($id, $data);


    /**
     * Delete an entry from the repository.
     * @param $id
     * @return mixed
     */
    public function delete($id);
} 