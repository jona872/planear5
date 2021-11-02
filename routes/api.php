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

// // Viejo, borrar despues===================
 Route::get('/post', 'APIController@postList');
// Route::post('/createPost', 'APIController@createPost');
// Route::get('/remove/post/{id}', 'APIController@removePost');
// Route::get('/post/{id}', 'APIController@postDetail');

// Route::get('/proyectos', 'APIController@index');
// Route::post('/proyecto', 'APIController@crearProyecto');
Route::post('/login', 'Auth\LoginController@login');
// ========================================


Route::get('/project-list', 'ProjectController@getProjects');

// //UPDATE->PUT-> Form/url encoded postman
Route::put('/proyecto-editar/{id}', 'ProjectController@update');
Route::put('/herramienta-editar/{id}', 'ToolController@update');


// //RESOURCES API  
Route::apiResources([
    'paises' => 'CountryController',
    'provincias' => 'ProvinceController',
    'ciudades' => 'CityController',
    'datos' => 'DataController',
    'herramientas' => 'ToolController',
    'proyectos' => 'ProjectController',
    'relevamientos' => 'RelevamientoController',
]);