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
    return view('pages.welcome');
});

Route::get('/login', function () {
    return view('layouts.app');

    // redirect to dashboard

});

Route::get('/register', function () {
    return view('layouts.app');

    // redirect to dashboard

});

Route::get('/homes', function () {
    return view('pages.results');
});

Route::get('/homes/{id}', function () {
    return view('pages.homesid');
});

Route::get('/dashboard', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
