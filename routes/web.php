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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cert/verify', 'HomeController@verify')->name('home');
Route::middleware('auth', 'throttle:5,1')->post('/validate', 'AdminActionsController@validateCert');
Route::middleware('auth', 'throttle:5,1')->get('/attemptTest/{id}','CertificationController@index')->name('attemptTest');
//todo work on restriction of downloding
//Route::middleware('auth')->get('/certificates/{id}','CertificationController@download')->name('attemptTest');
Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d/-/_.]+)?' );
