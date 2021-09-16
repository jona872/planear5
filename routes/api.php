<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RelevamientoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/post', 'APIController@postList');
Route::post('/createPost', 'APIController@createPost');
Route::get('/remove/post/{id}', 'APIController@removePost');
Route::get('/post/{id}', 'APIController@postDetail');


Route::get('/proyectos', 'APIController@index');
Route::post('/proyecto', 'APIController@crearProyecto');

//UPDATE->PUT-> Form/url encoded postman
Route::put('/proyecto-editar/{id}', 'ProjectController@update');
// //PROYECTOS API
Route::apiResources([
    'proyectos' => 'ProjectController',
    'relevamientos' => 'RelevamientoController',
]);