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

Route::prefix('contenido')->group(function() {
	Route::middleware('auth')->group(function(){
        Route::get('/', 'ContenidoController@index');
        Route::get('/private/perfilamiento/ver/{id}','PerfilamientoController@ver');


		Route::prefix('perfilamiento')->group(function(){
			Route::get('/roles','PerfilamientoController@index');
			Route::get('/usuarios','PerfilamientoController@users');

			//Crud Usuarios
			Route::resource('mantenedor-usuarios','UsuarioController');
			Route::delete('mantenedor-usuarios/{id}',
	        array(
	            'uses'=>'UsuarioController@destroy',
	            'as'=>'mantenedor-usuarios.delete'
	        ));
			//Crud Roles
			Route::resource('mantenedor-roles','RolController');
			Route::delete('mantenedor-roles/{id}',
	        array(
	            'uses'=>'RolController@destroy',
	            'as'=>'mantenedor-roles.delete'
	        ));


		});

		Route::prefix('configuracion')->group(function(){
		    Route::get('/page','ConfiguracionController@page');
		    Route::get('/css','ConfiguracionController@css');
		    Route::get('/info','ConfiguracionController@informacion');
		    Route::get('/mantenimiento','ConfiguracionController@mantenimiento');
		});

		Route::prefix('mantenedores')->group(function(){
			Route::get('/page','MantenedoresController@page');
			Route::get('/imagenes','MantenedoresController@imagenes');
			Route::get('/categoria','MantenedoresController@categoria');
			//Crud Categoria
			Route::resource('mantenedor-categoria','CategoriaController');
			Route::delete('mantenedor-categoria/{id}',
	        array(
	            'uses'=>'CategoriaController@destroy',
	            'as'=>'mantenedor-categoria.delete'
			));
			//crud Page
			Route::resource('mantenedor-page','PageController');
			Route::delete('mantenedor-page/{id}',
	        array(
	            'uses'=>'PageController@destroy',
	            'as'=>'mantenedor-page.delete'
			));


		});
		Route::prefix('editor')->group(function(){
			Route::get('/sliders','EditorController@slider');
			Route::get('/noticias','EditorController@noticias');
            Route::get('/categorias','EditorController@categoria');

            Route::get('/noticias/create','EditorController@create');
            Route::get('/cambiar-imagen/{id}','NoticiaController@cambiar');
            Route::put('/editar-imagen/{id}','NoticiaController@editar_imagen');
			//Crud Noticias Estandar
			Route::resource('mantenedor-noticias','NoticiaController');
			Route::delete('mantenedor-noticias/{id}',
	        array(
	            'uses'=>'NoticiaController@destroy',
	            'as'=>'mantenedor-noticias.delete'
            ));
            //Categoria Noticias de
            Route::resource('mantenedor-categorias','CategoriasNoticiasController');
			Route::delete('mantenedor-categorias/{id}',
	        array(
	            'uses'=>'CategoriasNoticiasController@destroy',
	            'as'=>'mantenedor-categorias.delete'
            ));
            //IMG
            Route::resource('mantenedor-imagen','NoticiaController');
			Route::delete('mantenedor-imagen/{id}',
	        array(
	            'uses'=>'NoticiaController@destroy',
	            'as'=>'mantenedor-noticias.delete'
			));
			//Crud Noticias Review
			Route::resource('mantenedor-review','ReviewController');
			Route::delete('mantenedor-review/{id}',
	        array(
	            'uses'=>'ReviewController@destroy',
	            'as'=>'mantenedor-review.delete'
			));

			Route::resource('mantenedor-slider','EditorController');
			Route::post('eliminar/{id}','EditorController@destroy');
			Route::get('publicar/{id}','EditorController@publicar');
			Route::get('bajar-publicacion/{id}','EditorController@bajar_publicacion');
		});
	});
});
