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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['password.request' => false, 'password.reset' => false]);

Route::group(['middleware' => 'api'], function () {
    Route::get('api', 'APIController@postList');
    //other routes 
});

Route::get('/home', 'HomeController@index')->name('home');
