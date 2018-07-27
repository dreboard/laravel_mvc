<?php
/**
 * Separate routes for the front end
 * The folder routes/front contains the
 */

Route::get(
    '/', function () {
    return view('front.home');
});


Route::get('/controllers', 'FrontController@index')->name('controllers');

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('/', function () {
    return view('front.home');
});