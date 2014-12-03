<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Page routes
     */
    Route::get($backend . '/pages',             ['uses' => 'PageController@index', 'as' => 'app.admin.pages']);
    Route::get($backend . '/pages/create',      ['uses' => 'PageController@create', 'as' => 'app.admin.pages.create']);
    Route::post($backend . '/pages/create',     ['uses' => 'PageController@save', 'as' => 'app.admin.pages.save']);
    Route::get($backend . '/pages/{id}/edit',   ['uses' => 'PageController@edit', 'as' => 'app.admin.pages.edit']);
    Route::post($backend . '/pages/{id}/edit',  ['uses' => 'PageController@update', 'as' => 'app.admin.pages.update']);
    Route::post($backend . '/pages/delete',     ['uses' => 'PageController@delete', 'as' => 'app.admin.pages.delete']);
});
