<?php


namespace Pageblok\CMS\Controllers;


use Pageblok\Core\Exceptions\PageblokException;
use Pageblok\Pages\Interfaces\PageRepositoryInterface;

class CMSController extends PageblokController
{

    protected $pageRepository;

    /**
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;

        parent::__construct();
    }

    /**
     * Main controller for Pageblok CMS
     *
     * @param String $slug
     * @throws PageblokException
     * @return Illuminate\Http\Response
     */
    public function main($slug = null)
    {
        $data['frontpage'] = false;

        if (is_null($slug)) {
            // get default slug defined in the database if no slug was given (means user wants the homepage)
            $slug = \Setting::get('app.pageblok.frontpage', 'frontpage');
            $data['frontpage'] = true;
        }

        $pageModel = $this->pageRepository->findBySlug($slug);

        if (is_null($pageModel)) {
            throw new PageblokException("Page not found for slug '$slug' ", 10);
        }

        /**
         * If a page has no template yet defined just output content of that page
         */
        if (!$pageModel->template) {
            echo $pageModel->writeContent();

            return; // move on nothing to see here

        }
        $data['page'] = $pageModel;

        $renderedPage = \View::make($pageModel->template, $data);

        return $renderedPage->render();
    }

} 