<?php
Route::get('site_home', 'SiteController@index')->name('site_home');
Route::get('site_new/{id?}', 'SiteController@create')->name('site_new');
Route::post('site_save', 'SiteController@save')->name('site_save');
Route::get('site_view/{id?}', 'SiteController@show')->name('site_view');
Route::get('site_projects/{id?}', 'SiteController@projects')->name('site_projects');
Route::get('site_calendar/{id?}', 'SiteController@calendar')->name('site_calendar');
Route::get('site_all', 'SiteController@all')->name('site_all');