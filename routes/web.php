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
Route::get('/map', 'LiveSearch@map');
Route::post('/google/map/store', 'LiveSearch@store')->name('google.map.store');

Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');



Route::get('/piePlot', 'PlotController@piePlot')->name('piePlot');
Route::get('/plots2', 'PlotController@plots2')->name('plots2');
Route::get('/plots3', function () {
    return view('plots.factores');
});
Route::get('/plots4', function () {
    return view('plots.tortas');
});

Route::get('/projects/action', 'ProjectController@action')->name('projects.action');
Route::post('/projects/search', 'ProjectController@search')->name('projects.search');



Route::get('/relevamientos/select-export', 'RelevamientoController@selectExport')->name('relevamientos.select-export');
Route::get('/relevamientos/getTools', 'RelevamientoController@getProjectTools')->name('relevamientos.getTools');
//Route::post('/relevamientos/getTools2', 'RelevamientoController@getProjectTools')->name('relevamientos.getTools2');
//Route::get('/relevamientos/find-tools', 'RelevamientoController@getProjectTools')->name('relevamientos.find-tools');


Route::post('/relevamientos/export', 'RelevamientoController@export')->name('relevamientos.export');
Route::post('/relevamientos/export-tool', 'RelevamientoController@exportTool')->name('relevamientos.export-tool');
Route::post('/relevamientos/export-tools', 'RelevamientoController@exportTools')->name('relevamientos.export-tools');

Route::post('/relevamientos/export-confirm', 'RelevamientoController@exportConfirm')->name('relevamientos.export-confirm');

Route::get('/relevamientos/import-picker', 'RelevamientoController@picker')->name('relevamientos.import-picker');
Route::post('/relevamientos/import-preview', 'RelevamientoController@preview')->name('relevamientos.import-preview');
Route::post('/fileUpload', 'RelevamientoController@fileUpload')->name('fileUpload');

Route::post('/relevamientos/name-search', 'RelevamientoController@nameSearch')->name('relevamientos.name-search');
Route::post('/relevamientos/date-search', 'RelevamientoController@dateSearch')->name('relevamientos.date-search');



Route::post('/plots/process', 'PlotController@process')->name('plots.process');
Route::post('/plots/multiplotProcess', 'PlotController@multiplotProcess')->name('plots.multiplotProcess');
Route::get('/exportador', 'CsvController@index')->name('exportador');

Route::get('create-chart/{type}', 'PlotController@makeChart');

Route::get('data/destroy/{id}', 'DataController@destroy');


Route::get('relevamientos/pre-create', 'RelevamientoController@preCreate')->name('relevamientos.pre-create');
Route::post('relevamientos/pos-create', 'RelevamientoController@posCreate')->name('relevamientos.poscreate');

Route::post('/cities/getCities/', 'CityController@getCities')->name('cities.getCities');
Route::post('/data/customize/', 'DataController@customize')->name('data.customize');

Route::get('/admin-panel/setAdmin', 'AdminController@setAdmin')->name('admin-panel.setAdmin');


Route::get('/home', 'HomeController@index')->name('home');


Route::resource('projects', 'ProjectController');
Route::resource('tools', 'ToolController');
Route::resource('cities', 'CityController');
Route::resource('data', 'DataController');
Route::resource('relevamientos', 'RelevamientoController');
Route::resource('plots', 'PlotController');
Route::resource('calcs', 'CalcController');

Route::resource('admin-panel', 'AdminController');






Auth::routes(['password.request' => false, 'password.reset' => false]);

Route::group(['middleware' => 'auth'], function () {
    //
});
