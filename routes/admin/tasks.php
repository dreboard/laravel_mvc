<?php

Route::post('task_update', 'TaskController@update')->name('task_update');
Route::post('task_new', 'TaskController@store')->name('task_new');