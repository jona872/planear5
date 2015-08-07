<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//entrada al sitio
Route::get('/', function () {
    return view('auth/login');
});

//Controles de logueo y registro
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('profile','ProfileController');//profile existe?//tienen otros campos como fotos etc..
Route::resource('home','HomeController');//todos los eventos que saen "visibles" no privados
Route::resource('event','EventController');//todos los events de 1 usuario {{Auth::user()->id}}
Route::resource('log','LogController');
Route::resource('genero','GeneroController');

Route::get('/generos','GeneroController@listing');