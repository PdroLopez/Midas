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

Route::middleware('auth:api')->get('/workflow', function (Request $request) {
    return $request->user();
});
Route::get('grupo-clasificacion/{id}','GestorController@GrupoClasificacion');
Route::get('clasificacion-subcategoria/{id}','GestorController@clasificacionsubcategoria');
Route::get('comunas/{id}','GestorController@buscar_comuna');
Route::get('get-direccion/{id}','GestorController@buscar_direccion');
Route::get('get-direccion/edit/{id}','GestorController@edit_buscar_direccion');
Route::get('get-marca/{id}','GestorController@buscar_marca');
Route::get('get-empresa/{id}','GestorController@buscar_empresa');
Route::get('get-residuo/{id}','GestorController@buscar_residuo');
Route::post('get-tipocarga-ticket','GestorController@session_tipocarga');