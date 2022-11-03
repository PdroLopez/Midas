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

Route::prefix('agendamiento')->group(function() {
    Route::get('/', 'AgendamientoController@index');
    Route::get('private/agendamiento','AgendamientoController@agendamiento');
    Route::get('private/horas-disponibles','AgendamientoController@horas_disponibles');
    Route::get('private/recursos','AgendamientoController@recursos');
    //CRUD AGENDAMIENTO
    Route::resource('mantenedor-agendamiento','AgendamientoController');
        Route::delete('mantenedor-agendamiento/{id}',array(
            'uses'=>'AgendamientoController@destroy',
            'as'=>'mantenedor-agendamiento.delete'
        ));

    //CRUD HORAS DISPONIBLES
    Route::post('/agregar-hora','HorasDisponiblesController@agregar');
    Route::post('/editar-hora/{id}','HorasDisponiblesController@editar');
    Route::post('/eliminar-hora/{id}','HorasDisponiblesController@eliminar');

    //CRUD RECURSOS
    Route::post('/agregar','RecursosController@agregar');
    Route::post('/editar/{id}','RecursosController@editar');
    Route::post('/eliminar/{id}','RecursosController@eliminar');

    //CRUD SEGUIMIENTO
    Route::resource('mantenedor-seguimiento','SeguimientoController');
        Route::delete('mantenedor-seguimiento/{id}',array(
            'uses'=>'SeguimientoController@destroy',
            'as'=>'mantenedor-seguimiento.delete'
        ));
});
