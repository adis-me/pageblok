<?php


namespace Pageblok\Core\Controllers;

use Illuminate\View\View;

/**
 * Class BaseController
 * @package Pageblok\Core\Controllers
 * @author Adis Corovic <adis@live.nl>
 */
abstract class BaseController extends \Controller
{
    protected $repository;
    protected $package;
    // Model variables
    protected $model;
    protected $modelName;
    protected $pluralModelName;

    protected $theme;
    protected $basePath;
    /**
     * Contains data that will be passed to the view
     * @var array
     */
    protected $data = array();


    /**
     * Default constructor
     */
    protected function __construct()
    {
        $this->basePath = base_path();

        $this->theme = \Config::get('pageblok::settings.theme');
        $this->themesFolder = \Config::get('pageblok::settings.theme.folder');
        $this->templatesFolder = \Config::get('pageblok::settings.templates');
        $this->uploadFolder = \Config::get('pageblok::settings.upload.folder');
        $this->thumbnailFolder = \Config::get('pageblok::settings.upload.thumbnails.folder');

        $this->model = $this->repository->getModel();
        $this->modelName = $this->model->getModelName();
        $this->pluralModelName = $this->model->getPluralModelName();
    }

    /**
     * Default index method, show a Collection of our current model.
     * @return View
     */
    protected function index()
    {
        // check if we defined already a collection for our model, if not get all models paginated
        if (!array_key_exists($this->pluralModelName, $this->data)) {
            $this->data[$this->pluralModelName] = $this->repository->allPaged();
        }

        if ($this->package) {
            return \View::make("{$this->package}{$this->pluralModelName}.index", $this->data);
        }
        return \View::make("{$this->pluralModelName}::index", $this->data);
    }

    /**
     * Show create form for current model.
     * @return View
     */
    public function create()
    {

        $this->data["$this->modelName"] = $this->model;
        $this->data["formRoute"] = "app.admin.$this->pluralModelName.create";


        if ($this->package) {
            return \View::make("{$this->package}{$this->pluralModelName}.form", $this->data);
        }
        return \View::make("{$this->pluralModelName}::form", $this->data);
    }

    /**
     * Save a new model to the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        if (!$this->repository->create($this->data)) {
            \Notification::error("{$this->pluralModelName} not saved");

            return \Redirect::route("app.admin.{$this->pluralModelName}.create");
        }

        \Notification::success("{$this->pluralModelName} saved");

        return \Redirect::route("app.admin.{$this->pluralModelName}");
    }

    /**
     * Show the edit form fr the current model.
     * @param $id
     * @return View
     */
    public function edit($id)
    {
        $this->data[$this->modelName] = $this->repository->findById($id);
        $this->data["formRoute"] = "app.admin.{$this->pluralModelName}.update";

        if ($this->package) {
            return \View::make("{$this->package}{$this->pluralModelName}.form", $this->data);
        }
        return \View::make("{$this->pluralModelName}::form", $this->data);
    }

    /**
     * Update a model to the database.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        if (!$this->repository->update($id, $this->data)) {
            \Notification::error("{$this->modelName} could not be created, please try again");

            return \Redirect::route("app.admin.{$this->pluralModelName}.edit", $id);
        }
        \Notification::success("{$this->modelName} updated");

        return \Redirect::route("app.admin.{$this->pluralModelName}");
    }

    /**
     * Delete one or more models by providing the id of the model(s) that should be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        $listIds = \Input::get('id');

        $deletionSucceeded = false;
        foreach ($listIds as $id) {
            if (is_null($this->repository->findById($id))) {
                \Notification::error("{$this->modelName} does not exists, already deleted?");

                return \Redirect::route("app.admin.{$this->pluralModelName}");
            }
            $deletionSucceeded .= $this->repository->delete($id);

        }

        if (!$deletionSucceeded) {
            \Notification::error("{$this->modelName} could not be deleted, please try again");
        }

        \Notification::success("Deletion succeeded");

        return \Redirect::route("app.admin.{$this->pluralModelName}");
    }
} 