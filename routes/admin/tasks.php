<?php

Route::post('task_update', 'TaskController@update')->name('task_update');
Route::post('task_new', 'TaskController@store')->name('task_new');
Route::post('new_note', 'NoteController@store')->name('new_note');
Route::get('ticket_notes/{id}', 'NoteController@getAllTicketNotes')->name('ticket_notes');