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

Route::get('/','HomeController@index');
Route::get('/package/activities/{id}','HomeController@show');
Route::post('/pacakage/activities/store','HomeController@store')->name('act.store');

Route::get('/dashboard','TourPackgeController@index');

//package type routes

Route::get('/packagetype','PackgeTypeController@index');
Route::post('/packagetype/store','PackgeTypeController@store')->name('store');
Route::get('/packagetype/getdata','PackgeTypeController@getdata');
Route::post('/packagetype/update','PackgeTypeController@update')->name('update');
Route::get('/packagetype/delete/{id}','PackgeTypeController@destroy');


//package routes
Route::get('/package','PackgeController@index');
Route::get('/package/create','PackgeController@create');
Route::post('/package/store','PackgeController@store')->name('package.store');
Route::get('/package/getdata','PackgeController@getdata');
Route::get('/package/edit/{id}','PackgeController@edit');
Route::post('/package/update/{id}','PackgeController@update')->name('package.update');
Route::get('/package/delete/{id}','PackgeController@destroy');

//package activation
Route::get('/packageactivation','PackageActivationController@index');
Route::get('/packageactivation/getdata','PackageActivationController@getdata');
Route::get('/packageactivation/delete/{id}','PackageActivationController@destroy');