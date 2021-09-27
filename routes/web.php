<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/test', function () {
    return response()->json([
        '1' => 'value1',
        '2' => 'value2',
        '3' => 'value3'
    ]);
});

Route::get('/exportador','CsvController@index')->name('exportador');


Auth::routes(['password.request' => false, 'password.reset' => false]);

Route::group(['middleware'=>'auth'],function () {
    Route::get('create-chart/{type}','PlotController@makeChart');

    Route::get('/data/create/','DataController@create')->name('data.create');
    Route::get('/data/test/','DataController@test')->name('data.test');
    Route::get('data/destroy/{id}','DataController@destroy');
    Route::get('relevamientos/pre-create','RelevamientoController@preCreate')->name('relevamientos.pre-create');
    Route::post('relevamientos/pos-create','RelevamientoController@posCreate')->name('relevamientos.poscreate');
    
    Route::post('/cities/getCities/','CityController@getCities')->name('cities.getCities');
    Route::post('/data/customize/','DataController@customize')->name('data.customize');
    
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('projects','ProjectController');
    Route::resource('tools','ToolController');
    Route::resource('cities','CityController');
    Route::resource('data','DataController');
    Route::resource('relevamientos','RelevamientoController');
    Route::resource('plots','PlotController');
    Route::resource('calcs','CalcController');
    
    Route::resource('admin-panel','UserController');
    //
});