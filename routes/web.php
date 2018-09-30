<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/employees', function () {
    return view('employees');
});

Route::get('/','Controller@getDate');
Route::post('/insert','Controller@insert');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');