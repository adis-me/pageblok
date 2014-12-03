<?php


namespace Pageblok\Settings\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Settings\Interfaces\SettingRepositoryInterface;

/**
 * Class SettingsController
 * @package Pageblok\Settings\Controllers
 * @author Adis Corovic <adis@live.nl>
 */
class SettingsController extends BaseController
{

    protected $package = "pageblok::";
    /**
     * Default constructor
     * @param SettingRepositoryInterface $settingRepository
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->repository = $settingRepository;

        parent::__construct();
    }

    public function create()
    {
        $this->data = [
            'environments' => $this->getEnvironments(),
        ];

        return parent::create();
    }

    public function save()
    {
        $this->data = [
            'key' => \Input::get('key'),
            'value' => \Input::get('value'),
            'description' => \Input::get('description'),
            'environment' => \Input::get('environment'),
            'created_by' => \Auth::user()->id,
        ];

        return parent::save();
    }

    public function edit($id)
    {
        $this->data = [
            'environments' => $this->getEnvironments(),
        ];

        return parent::edit($id);
    }

    public function update($id)
    {
        $this->data = [
            'key' => \Input::get('key'),
            'value' => \Input::get('value'),
            'description' => \Input::get('description'),
            'environment' => \Input::get('environment'),
            'created_by' => \Auth::user()->id,
        ];

        return parent::update($id);
    }

    /**
     * @return array
     */
    private function getEnvironments()
    {
        return array(
            'local' => 'Development',
            'production' => 'Production'
        );
    }
} 