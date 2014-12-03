<?php


namespace Pageblok\CMS\Controllers;


class SettingsController extends PageblokController
{

    public function __construct()
    {
        $this->beforeFilter('auth');

        parent::__construct();
    }

    public function index()
    {

        $data = array(
            'siteSettings' => $this->getSettings(),
        );

        return \View::make("pageblok::settings.index", $data);
    }

    /**
     * Return array of site settings.
     *
     * @return array
     */
    private function getSettings()
    {
        return array(
            'frontpage' => array(
                'name' => 'Frontpage',
                'key'  => 'frontpage',
                'type' => 'text',
                'help' => 'Type the slug of the home page'
            ),

        );
    }


    public function edit($key)
    {
        $data = array(
            'siteSettings' => $this->getSettings(),
            'setting'      => $this->getSettings()[key],
        );

        return \View::make("pageblok::settings.index", $data);
    }

    public function update($key)
    {

    }
} 