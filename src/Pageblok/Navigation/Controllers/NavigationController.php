<?php


namespace Pageblok\Navigation\Controllers;

use Pageblok\Core\Controllers\BaseController;
use Pageblok\Navigation\Interfaces\NavigationRepositoryInterface;


/**
 * Class NavigationController
 * @package Pageblok\Navigation\Controllers
 */
class NavigationController extends BaseController
{
    protected $package = 'pageblok::';

    /**
     * @param NavigationRepositoryInterface $repository
     */
    public function __construct(NavigationRepositoryInterface $repository)
    {
        $this->repository = $repository;
        // set initial backend url
        $this->repository->getModel()->href = \Config::get('pageblok::settings.backend') . '/';
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->data = [
            'name' => \Input::get('name'),
            'title' => \Input::get('title'),
            'description' => \Input::get('description'),
            'css_classes' => \Input::get('css_classes'),
            'href' => \Input::get('href'),
            'route_name' => \Input::get('route_name'),
            'created_by' => \Auth::user()->id,
        ];

        return parent::save();
    }


    /**
     * @inheritdoc
     */
    public function update($id)
    {
        $this->data = [
            'name' => \Input::get('name'),
            'title' => \Input::get('title'),
            'description' => \Input::get('description'),
            'css_classes' => \Input::get('css_classes'),
            'href' => \Input::get('href'),
            'route_name' => \Input::get('route_name'),
        ];

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::update($id);
    }
} 