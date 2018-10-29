<?php

Route::middleware(['auth'])->group(function () {
    Route::get('showCycleForm', 'CycleController@showCycleForm')->name('showCycleForm');
    Route::post('saveNewCycle', 'CycleController@saveNewCycle')->name('saveNewCycle');
    Route::get('viewCycle', 'CycleController@viewCycle')->name('viewCycle');

    // Route Model Binding Version
    Route::get('cycles/{id}', 'CycleController@show')->name('cycles');

    Route::get('allCycle', 'CycleController@getAllCycles')->name('allCycle');
    Route::get('viewCycleById/{id}', 'CycleController@viewCycleById')->name('viewCycleById');

    Route::post('updateCycle', 'CycleController@updateCycle')->name('updateCycle');

    Route::get('cycle_home', 'CycleController@index')->name('cycle_home');
    Route::get('cycle_new/{id?}', 'CycleController@create')->name('cycle_new');
    Route::post('cycle_save', 'CycleController@save')->name('cycle_save');
    Route::get('cycle_view/{id?}', 'CycleController@show')->name('cycle_view');
    Route::get('cycle_all', 'CycleController@all')->name('cycle_all');

    Route::get('project_home', 'ProjectController@index')->name('project_home');
    Route::get('project_new/{id?}', 'ProjectController@create')->name('project_new');
    Route::post('project_save', 'ProjectController@save')->name('project_save');
    Route::get('project_view/{id?}', 'ProjectController@show')->name('project_view');
    Route::get('project_all', 'ProjectController@all')->name('project_all');

    // Ticket routes
    require_once __DIR__.'/tickets.php';

    // Sites routes
    require_once __DIR__.'/sites.php';

    // Task routes
    require_once __DIR__.'/tasks.php';
});

Route::get('/links', 'FrontController@getTechText');


Route::get('/mailable', function () {
    $cycle = App\Cycle::find(1);
    return new App\Mail\CycleCreatedMailable($cycle);
});