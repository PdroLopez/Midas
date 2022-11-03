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

Route::middleware('auth:api')->get('/tienda', function (Request $request) {
    return $request->user();
});

Route::get('comunas/{id}','TiendaController@buscar_comuna');
Route::get('region/comuna/{region}/{comuna}','TiendaController@region_comuna');
Route::get('rut-verificar/{rut}','TiendaController@rut_verificar');