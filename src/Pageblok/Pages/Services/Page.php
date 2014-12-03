<?php


namespace Pageblok\Pages\Services;


use Pageblok\Pages\Interfaces\PageRepositoryInterface;

class Page
{

    protected $repository;

    protected $bag;

    public function __construct(PageRepositoryInterface $repository)
    {

        $this->repository = $repository;

        $this->loadFromRepository();

    }

    public function loadFromRepository()
    {
        $this->repository->all()->each(
            function ($page) {
                $this->bag[$page->pb_name] = $page;
            }
        );
    }

    /**
     * Get default page template
     *
     * @return string Default page template name
     */
    public function getDefaultTemplate()
    {
        return \Config::get('pageblok::settings.default.page.template');
    }

} 