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
    return view('welcome');
});


Route::group(['prefix' => 'joke'], function () {
    Route::get('/', 'JokeController@index')->name('joke.index');
    Route::get('/random', 'JokeController@random')->name('joke.random');
    Route::get('/search', 'JokeController@search')->name('joke.search');
});
