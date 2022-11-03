<?php

use Illuminate\Http\Request;

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
Route::get('/prueba','PruebaApiController@prueba');
Route::get('/crear-usuario','PruebaApiController@crearUsuario');
Route::get('/crear-paciente','PruebaApiController@crearUsuarioPaciente');
Route::get('/pago-consulta','PruebaApiController@transbank');
Route::get('/solicitar-retiro','PruebaApiController@solicitarRetiro');
Route::post('/webhook', 'PruebaApiController@webhook');
Route::post('/prueba-pago','PruebaApiController@prueba_pago');
Route::get('/return','PruebaApiController@return');
Route::get('/consulta-transaccion','PruebaApiController@prueba_transaccion');
Route::get('grupo-clasificacion/{id}','SitesController@GrupoClasificacion');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
