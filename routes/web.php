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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	Route::get('alumnos', 'AlumnoController@index');
	Route::get('alumnos/gestion', 'AlumnoController@create');
	Route::resource('cursos', 'CursoController');
	Route::resource('materias', 'MateriaController');
	Route::resource('preceptores', 'PreceptorController');
	Route::resource('profesores', 'ProfesorController');
	Route::get('usuarios', 'HomeController@create');
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});