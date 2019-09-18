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
	Route::post('alumnos/nuevo', 'AlumnoController@store');
	Route::delete('alumnos/eliminar/{id}', 'AlumnoController@destroy');
	Route::post('alumnos/actualizar', 'AlumnoController@update');

	Route::get('profesores', 'ProfesorController@index');
	Route::get('profesores/gestion', 'ProfesorController@create');
	Route::post('profesores/nuevo', 'ProfesorController@store');
	Route::delete('profesores/eliminar/{id}', 'ProfesorController@destroy');
	Route::post('profesores/actualizar', 'ProfesorController@update');

	Route::get('preceptores', 'PreceptorController@index');
	Route::get('preceptores/gestion', 'PreceptorController@create');
	Route::post('preceptores/nuevo', 'PreceptorController@store');
	Route::delete('preceptores/eliminar/{id}', 'PreceptorController@destroy');
	Route::post('preceptores/actualizar', 'PreceptorController@update');

	Route::get('materias', 'MateriaController@index');
	Route::get('materias/gestion', 'MateriaController@create');
	Route::post('materias/nuevo', 'MateriaController@store');
	Route::delete('materias/eliminar/{id}', 'MateriaController@destroy');
	Route::post('materias/actualizar', 'MateriaController@update');

	Route::get('cursos', 'CursoController@index');
	Route::get('cursos/gestion', 'CursoController@create');
	Route::post('cursos/nuevo', 'CursoController@store');
	Route::delete('cursos/eliminar/{id}', 'CursoController@destroy');
	Route::post('cursos/actualizar', 'CursoController@update');
	Route::get('cursos/materias/{id}', 'CursoController@materias_curso');
	Route::get('cursos/alumnos/{id}', 'CursoController@alumnos_curso');
	Route::post('cursos/alumnos/actualiar_alumnos', 'CursoController@alumnos_en_curso');

	Route::get('usuarios', 'HomeController@create');
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});