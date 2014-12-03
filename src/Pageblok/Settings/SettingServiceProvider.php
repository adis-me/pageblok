<?php


namespace Pageblok\Settings;


use Illuminate\Support\ServiceProvider;
use Pageblok\Settings\Services\Setting;

class SettingServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \App::singleton(
            'settings',
            function () {
                return new Setting(\App::make('SettingRepository'));
            }
        );
    }
}