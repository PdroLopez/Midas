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

// Route::prefix('dgr')->group(function() {
//     Route::get('/', 'DgrController@index')->middleware('auth','role:admin');
// });


Route::group(['middleware' => ['auth','role:DGR'], 'prefix' => 'dgr'], function()
{
    Route::get('/', 'DgrController@index');

    Route::resource('roles', 'RolesController');
    Route::delete('roles/{id}',
        array('uses'=>'RolesController@destroy','as'=>'roles.delete'));
    
    Route::resource('usuarios', 'UsuariosController');
    Route::delete('usuarios/{id}',
        array('uses'=>'UsuariosController@destroy','as'=>'usuarios.delete'));

    Route::resource('configuracion', 'ConfiguracionController');
    Route::delete('configuracion/{id}',
        array('uses'=>'ConfiguracionController@destroy','as'=>'configuracion.delete'));

    Route::resource('img', 'ImgController');
    Route::delete('img/{id}',
        array('uses'=>'ImgController@destroy','as'=>'img.delete'));


    Route::group(['prefix' => 'portal'], function()
	{
        Route::resource('pagina', 'PortalPaginaController');
        Route::delete('pagina/{id}',
            array('uses'=>'PortalPaginaController@destroy','as'=>'pagina.delete'));

        Route::resource('menu', 'PortalMenuController');
        Route::delete('menu/{id}',
            array('uses'=>'PortalMenuController@destroy','as'=>'menu.delete'));
	});

    Route::group(['prefix' => 'private'], function()
    {
        Route::resource('nav', 'PrivateNavController');
        Route::delete('nav/{id}',
            array('uses'=>'PrivateNavController@destroy','as'=>'nav.delete'));

        Route::resource('nav-rol', 'RoleNavController');
        Route::delete('nav-rol/{id}',
            array('uses'=>'RoleNavController@destroy','as'=>'nav-rol.delete'));

        Route::resource('modulos','ModulosController');
        Route::delete('modulos/{id}', 
            array('uses'=>'ModulosController@destroy','as'=>'modulos.delete'));
    });
 

});