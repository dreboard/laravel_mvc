<?php

Route::middleware(['auth'])->group(function () {
    Route::get('showCycleForm', 'CycleController@showCycleForm')->name('showCycleForm');
    Route::post('saveNewCycle', 'CycleController@saveNewCycle')->name('saveNewCycle');
    Route::get('viewCycle', 'CycleController@viewCycle')->name('viewCycle');
    Route::get('allCycle', 'CycleController@getAllCycles')->name('allCycle');
    Route::get('viewCycleById/{id}', 'CycleController@viewCycleById')->name('viewCycleById');
});
