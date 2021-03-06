<?php


Route::get('ticket_home', 'TicketController@index')->name('ticket_home');
Route::get('ticket_new/{id?}', 'TicketController@create')->name('ticket_new');
Route::post('ticket_save', 'TicketController@save')->name('ticket_save');
Route::get('ticket_view/{id?}', 'TicketController@show')->name('ticket_view');
Route::get('ticket_all', 'TicketController@all')->name('ticket_all');


Route::get('ticket_edit/{id}', 'TicketController@edit')->name('ticket_edit');
Route::get('ticket_files/{id}', 'TicketController@edit')->name('ticket_files');

Route::post('ticket_edit_status', 'TicketController@changeStatus')->name('ticket_edit_status');
Route::post('ticket_edit_complete', 'TicketController@changeCompleted')->name('ticket_edit_complete');
