<?php

Route::group(['before' => 'auth'], function () {

        Route::post('assets/upload', ['uses' => 'AssetController@uploadAsset', 'as' => 'app.assets.upload']);

        $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

        /**
         * Dashboard routes
         */
        Route::get($backend, ['uses' => 'DashboardController@index', 'as' => 'app.admin.dashboard']);

        /**
         * Setting routes
         */
        Route::get($backend . '/settings', ['uses' => 'SettingsController@index', 'as' => 'app.admin.settings']);
        Route::get($backend . '/settings/create', ['uses' => 'SettingsController@create', 'as' => 'app.admin.settings.create']);
        Route::post($backend . '/settings/create', ['uses' => 'SettingsController@save', 'as' => 'app.admin.settings.save']);
        Route::get($backend . '/settings/{id}/edit', ['uses' => 'SettingsController@edit', 'as' => 'app.admin.settings.edit']);
        Route::post($backend . '/settings/{id}/edit', ['uses' => 'SettingsController@update', 'as' => 'app.admin.settings.update']);
        Route::post($backend . '/settings/delete', ['uses' => 'SettingsController@delete', 'as' => 'app.admin.settings.delete']);

        /**
         * Backend navigation routes
         */
        Route::get($backend . '/navigation', ['uses' => 'NavigationController@index', 'as' => 'app.admin.navigations']);
        Route::get($backend . '/navigation/create', ['uses' => 'NavigationController@create', 'as' => 'app.admin.navigations.create']);
        Route::post($backend . '/navigation/create', ['uses' => 'NavigationController@save', 'as' => 'app.admin.navigations.save']);
        Route::get($backend . '/navigation/{id}/edit', ['uses' => 'NavigationController@edit', 'as' => 'app.admin.navigations.edit']);
        Route::post($backend . '/navigation/{id}/edit', ['uses' => 'NavigationController@update', 'as' => 'app.admin.navigations.update']);
        Route::post($backend . '/navigation/delete', ['uses' => 'NavigationController@delete', 'as' => 'app.admin.navigations.delete']);

    }
);