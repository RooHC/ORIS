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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// PERFILES
Route::get('/alumno/{user}', 'AlumnoController@show')->name('alumno.show');
Route::get('/profesor/{user}', 'ProfesorController@show')->name('profesor.show');

// PRESENTACIONES
Route::get('/presentacion/create', 'PresentacionController@create')->name('presentacion.create');
Route::post('/presentacion', 'PresentacionController@store')->name('presentacion.store');
Route::get('/presentacion', 'PresentacionController@search')->name('presentacion.search');
Route::get('/presentacion/{presentacion}', 'PresentacionController@show')->name('presentacion.show');
Route::get('/presentacion/{presentacion}/edit', 'PresentacionController@edit')->name('presentacion.edit');
Route::put('/presentacion/{presentacion}', 'PresentacionController@update')->name('presentacion.update');
Route::get('/presentacion/delete/{presentacion}', 'PresentacionController@destroy')->name('presentacion.destroy');
Route::get('/presentacion/detail/{pregunta}', 'PresentacionController@detail')->name('presentacion.detail');

// PREGUNTAS
Route::get('/pregunta/create/{presentacion}', 'PreguntaController@create')->name('pregunta.create');
Route::post('/pregunta', 'PreguntaController@store')->name('pregunta.store');
Route::get('/pregunta/{presentacion}/edit', 'PreguntaController@edit')->name('pregunta.edit');
Route::put('/pregunta/{pregunta}', 'PreguntaController@update')->name('pregunta.update');
Route::get('/pregunta/delete/{pregunta}', 'PreguntaController@destroy')->name('pregunta.destroy');

// RESPUESTAS
Route::post('/respuesta', 'RespuestaController@store')->name('respuesta.store');
Route::put('/respuesta/{opinion}', 'RespuestaController@update')->name('respuesta.update');

// LIKES
Route::post('/opiniones/{opinion}/likes', 'OpinionLikeController@store')->name('like.store');
Route::delete('/opiniones/{opinion}/likes', 'OpinionLikeController@destroy')->name('like.destroy');

// ASIGNATURAS
Route::get('/asignatura/create', 'AsignaturaController@create')->name('asignatura.create');
Route::post('/asignatura', 'AsignaturaController@store')->name('asignatura.store');
Route::get('/asignatura/{asignatura}', 'AsignaturaController@show')->name('asignatura.show');

//SUSCRIPCIONES
Route::post('/suscripcion', 'SuscripcionController@store')->name('suscripcion.store');

// CONTACTO
Route::get('/contacto', function () {
    return view('contacto.index');
});
