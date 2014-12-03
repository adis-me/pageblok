<?php

namespace Pageblok\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Pageblok\Navigation\Models\Navigation;
use Pageblok\Navigation\Repositories\NavigationRepository;
use Pageblok\Settings\Models\Setting;
use Pageblok\Settings\Repositories\SettingRepository;

/**
 * Class RepositoryProvider
 * @author Adis Corovic <adis@live.nl>
 */
class RepositoryProvider extends ServiceProvider
{

    public function register()
    {

        // KEEP THEM ALPHABETICALLY!!!

        // N
        $this->app->bind(
            'NavigationRepository',
            function () {
                return new NavigationRepository(new Navigation());
            }
        );

        // S
        $this->app->bind(
            'SettingRepository',
            function () {
                return new SettingRepository(new Setting());
            }
        );
    }
}
