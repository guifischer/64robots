<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('person', 'PersonController@list');
    Route::get('person/{id}', 'PersonController@get');
    Route::post('person', 'PersonController@create');
    Route::post('person/{id}/relate-family', 'PersonController@relateFamily');
    Route::put('person/{id}', 'PersonController@update');
    Route::delete('person/{id}', 'PersonController@delete');

    Route::get('family', 'FamilyController@list');
    Route::get('family/{id}', 'FamilyController@get');
    Route::post('family', 'FamilyController@create');
    Route::put('family/{id}', 'FamilyController@update');
    Route::delete('family/{id}', 'FamilyController@delete');
});
