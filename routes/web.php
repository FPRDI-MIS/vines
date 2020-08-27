<?php

use Illuminate\Support\Facades\Route;

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
// Welcome route
Route::get('/', function () {
    return view('welcome');
});

// Vines entries routes
Route::get('/vines', 'VinesController@index')->name('vines-index');
Route::get('/vines/create', 'VinesController@create')->name('vines-create');
Route::post('/vines/store', 'VinesController@store')->name('vines-store');
Route::get('/vines/{id}', 'VinesController@show')->name('vines-show');
Route::get('/vines/{id}/edit', 'VinesController@edit')->name('vines-edit');
Route::put('/vines/{id}', 'VinesController@update')->name('vines-update');
Route::delete('/vines/{id}', 'VinesController@destroy')->name('vines-destroy');

Route::get('/search', 'VinesController@search')->name('search-show');
Route::post('/search', 'VinesController@search')->name('search-show');

// Pictures of vines entries routes
Route::get('/pictures/create/{vineId}', 'PicturesController@create')->name('pictures-create');
Route::post('/pictures/store', 'PicturesController@store')->name('pictures-store');

// Authorization routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
