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

Route::middleware('auth:api')->get('/login', function (Request $request) {
    return $request->user();
});
Route::get('region/{id}/comuna', 'SelectController@SelectComunas');
Route::get('rut-verificar/{rut}','SelectController@rut');
Route::get('email-check/{email}','SelectController@mail_check');