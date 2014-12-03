<?php


namespace Pageblok\Pages\Databases;


use Pageblok\Pages\Models\Page;
use Pageblok\Pages\Repositories\PageRepository;

class PageSeeder extends \Seeder
{

    public function run()
    {
        $frontPage = array(
            'slug' => 'frontpage',
            'title' => 'Welcome to our homepage',
            'description' => 'A Sample frontpage',
            'page_type' => 'page',
            'template' => 'templates.frontpage',
            'content_type' => 'html',
            'content' => '<strong>Sample page content</strong>',
            'published' => true,
            'created_by' => 1
        );

        $pagePostModel = new Page();
        $pagePostModel->fill($frontPage);
        $pagePostRepository = new PageRepository($pagePostModel);
        $pagePostRepository->create();

    }

} 