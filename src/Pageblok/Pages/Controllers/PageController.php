<?php


namespace Pageblok\Pages\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Pageblok\Controllers\PageblokController;
use Pageblok\Pages\Interfaces\PageRepositoryInterface;

class PageController extends BaseController
{

    protected $package = 'pageblok::';
    
    /**
     *
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->repository = $pageRepository;

        parent::__construct();
    }

    /**
     * Show create page form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->data = [
            'templates' => \Pageblok::getTemplates('page'),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Page::getDefaultTemplate(),
        ];

        return parent::create();
    }

    /**
     * Save a new page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->data = [
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'subtitle' => \Input::get('subtitle'),
            'description' => \Input::get('description'),
            'page_type' => 'page',
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'css_classes' => \Input::get('css_classes'),
            'image_ref' => \Pageblok::uploadFile(\Input::file('image_ref')),
            'content' => \Input::get('content'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
        ];

        if (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::save();
    }

    /**
     * Show edit form for a page
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = [
            'templates' => \Pageblok::getTemplates('page'),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Page::getDefaultTemplate(),
        ];

        return parent::edit($id);
    }

    /**
     * Update an existing page.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {

        $this->data = [
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'subtitle' => \Input::get('subtitle'),
            'page_type' => 'page',
            'description' => \Input::get('description'),
            'group' => \Input::get('group'),
            'css_classes' => \Input::get('css_classes'),
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'content' => \Input::get('content'),
            'published' => \Input::get('published')
        ];

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::update($id);
    }

} 