<?php


namespace Pageblok\Settings\Services;

use Pageblok\Settings\Interfaces\SettingRepositoryInterface;

/**
 * Class Setting
 *
 * @package Pageblok\Settings\Services
 * @author  Adis Corovic <adis@live.nl>
 */
class Setting
{
    protected $repository;

    /**
     * @var array contains all our settings
     */
    protected $settingsBag;

    /**
     * Default constructor
     *
     * @param SettingRepositoryInterface $repository
     */
    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->loadSettingsBag();
    }

    /**
     * Load settings bag from the database.
     */
    public function loadSettingsBag()
    {
        $this->repository->all()->each(
            function ($setting) {
                $this->settingsBag[$setting->key] = $setting;
            }
        );
    }


    /**
     * Get a setting based on the $settingsKey
     *
     * @param        $settingKey
     * @param string $defaultValue
     *
     * @return mixed
     */
    public function get($settingKey, $defaultValue = null)
    {

        if (isset($this->settingsBag[$settingKey])) {

            return $this->settingsBag[$settingKey]->value;
        } elseif ($defaultValue) {

            return $defaultValue;
        }

        \Log::error('Requested setting that does not exists!');

        // other cases just return empty value, because it is not set

        $this->addNewSetting($settingKey);

        return '';
    }

    /**
     * Add new key if this is the local development environment
     *
     * @param $settingKey
     */
    public function addNewSetting($settingKey)
    {
        if ('local' === \App::environment()) {
            $this->repository->create(
                array(
                    'key'         => $settingKey,
                    'environment' => \App::environment(),
                    'created_by'  => \Auth::id(),
                    'value'       => '',
                )
            );
        }
    }


}