<?php


namespace Pageblok\CMS\Controllers;


class DashboardController extends PageblokController
{
    protected $pageRepository;
    protected $blockRepository;
    protected $eventRepository;

    public function __construct()
    {
        $this->pageRepository = \App::make('PageRepository');
        $this->blockRepository = \App::make('BlockRepository');
        $this->eventRepository = \App::make('EventRepository');

        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'pages' => $this->pageRepository->all(),
            'blocks' => $this->blockRepository->all(),
            'events' => $this->eventRepository->all(),
        );

        return \View::make("pageblok::dashboard", $data);
    }
}