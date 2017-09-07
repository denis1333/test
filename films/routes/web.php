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

Route::get('/','MainController@showmainpage')->name('home');
Route::get('/add','MainController@showAddPage');
Route::get('editfilm/{filmId}','MainController@editFilmPage');
Route::post('editfilm/','MainController@editFilmPageSave');
Route::post('/add','MainController@addFilm');
Route::post('/addTag','MainController@addTag');
Route::post('/delFilm','MainController@delFilm');
Route::post('/delTagGlobal','MainController@delTagGlobal');