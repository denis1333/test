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

Route::get('/','HomeController@showMainpage');
Route::post('/delFilm','HomeController@delFilm');
Route::post('/delTagGlobal','HomeController@delTagGlobal');
Route::get('editfilm/{filmId}','EditFilmController@editFilmPage');
Route::post('editfilm/','EditFilmController@editFilmPageSave');
Route::post('/add','AddFilmAndTagController@addFilm');
Route::post('/addTag','AddFilmAndTagController@addTag');
Route::get('/add','AddFilmAndTagController@showAddPage');