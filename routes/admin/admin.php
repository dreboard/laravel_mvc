<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/user_all', 'AdminController@all')->name('user_all');
    Route::get('/user_clone/{id}', 'AdminController@cloneUser')->name('user_clone');
    Route::get('/admin_login', 'AdminController@adminLogin')->name('admin_login');

});