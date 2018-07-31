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

Route::view('/cycle_controller', 'front.controllers.CycleController')->name('cycle_controller');


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