<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    Route::get($backend . '/blocks',            ['uses' => 'BlockController@index', 'as' => 'app.admin.blocks']);
    Route::get($backend . '/blocks/create',     ['uses' => 'BlockController@create', 'as' => 'app.admin.blocks.create']);
    Route::post($backend . '/blocks/create',    ['uses' => 'BlockController@save', 'as' => 'app.admin.blocks.save']);
    Route::get($backend . '/blocks/{id}/edit',  ['uses' => 'BlockController@edit', 'as' => 'app.admin.blocks.edit']);
    Route::post($backend . '/blocks/{id}/edit', ['uses' => 'BlockController@update', 'as' => 'app.admin.blocks.update']);
    Route::post($backend . '/blocks/delete',    ['uses' => 'BlockController@delete', 'as' => 'app.admin.blocks.delete']);
});