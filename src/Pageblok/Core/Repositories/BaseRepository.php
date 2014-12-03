<?php


namespace Pageblok\Core\Repositories;

use Pageblok\Core\Interfaces\BaseModelInterface;
use Pageblok\Core\Interfaces\BaseRepositoryInterface;
use Pageblok\Core\Interfaces\Illuminate;
use Pageblok\Core\Interfaces\Pageblok;

/**
 * Abstract class BaseRepository
 * @package Pageblok\Core\Repositories
 * @author Adis Corovic <adis@live.nl>\
 */
abstract class BaseRepository implements BaseRepositoryInterface

{
    /**
     * @var \Pageblok\Core\Models\BaseModel
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(BaseModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Convenient method to get the model
     * @return \Pageblok\Core\Models\BaseModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Convenient method to set the model
     * @param \Pageblok\Core\Interfaces\BaseModelInterface $model
     * @return \Pageblok\Core\Models\BaseModel
     */
    public function setModel(BaseModelInterface $model)
    {
        return $this->model = $model;
    }


    /**
     * @inheritdoc
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @inheritdoc
     */
    public function allPaged()
    {
        return $this->model->paginate($this->model->getPageSize());
    }

    /**
     * @inheritdoc
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($id, $data)
    {
        return $this->findById($id)->fill($data)->save();
    }

    /**
     * @inheritdoc
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}