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



Route::get('/data','DataController@index');
Route::post('/data/create','DataController@create');
Route::get('/data/{id}/edit','DataController@edit');
Route::post('/data/{id}/update','DataController@update');
Route::get('/data/{id}/delete','DataController@delete');
Route::post('/data/search','DataController@search');
Route::post('/data/search2','DataController@search');
Route::get('/peta','PetaController@index');
Route::get('/','PetaController@index');
Route::get('/create-pallete','PetaController@createPallette');
Route::get('/getData','PetaController@getData');
Route::get('/getPositif','PetaController@getPositif');
/*Route::post('/peta/search','PetaController@search');*/