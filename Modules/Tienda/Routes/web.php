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
Route::get('/p/FDGR', 'TiendaController@ver_bauche');
Route::post('buscar-codigo', 'TiendaController@verificar_codigo');

Route::get('/v/pro/{id}/paso-1','TiendaController@getVentaCortaPaso1');
Route::get('/kit','TiendaController@VentaCortaPaso1');


Route::prefix('tienda')->group(function() {
    Route::get('/', 'TiendaController@index');
    //Route::get('/admin', 'TiendaController@admin')->middleware('auth');
    Route::get('/carro', 'TiendaController@carro');
    Route::get('/contacto', 'TiendaController@contacto');
    Route::get('/{id}/si-util', 'ComentariosController@si_util');
    Route::get('/{id}/no-util', 'ComentariosController@no_util');

    //ventas
    Route::get('/venta-corta/producto/{id}/paso-1','TiendaController@getVentaCortaPaso1');
    Route::get('/v/producto/{id}/paso-1','TiendaController@getVentaCortaPaso1');

    Route::get('/venta-corta/producto/{id}/paso-2','TiendaController@getVentaCortaPaso2');
    Route::get('/venta-corta/producto/{id}/paso-3','TiendaController@getVentaCortaPaso3');
    Route::get('/venta-corta/producto/{id}/paso-4','TiendaController@getVentaCortaPaso4');
    Route::get('/venta-corta/cancelar','VentaFueraController@cancelar');
    Route::post('/venta-corta/agregar/pago','VentaFueraController@formaPagoCant');
     Route::get('/venta-corta/final-compra/{id}', 'TiendaController@final_compra_rapida');
     Route::get('/venta-corta/final-compra-webpay', 'TiendaController@final_compra_webpay');

     Route::get('/venta-corta/buscar-comuna/{id}', 'TiendaController@buscar_comuna');
     Route::get('/venta-corta/despacho-elegido/{id}', 'VentaController@despachoElegido');
     Route::get('/export-ventas', 'VentaController@ExportarVenta');
     Route::get('/export-ventas/webpay', 'VentaController@ExportarVentaWebPay');
     

    Route::resource('mantenedor-venta-fuera','VentaFueraController');
            Route::delete('mantenedor-venta-fuera/{id}',
            array(
                    'uses'=>'VentaFueraController@destroy',
                    'as'=>'mantenedor-venta-fuera.delete'
            ));

    Route::resource('mantenedor-ventas','VentaController');
            Route::delete('mantenedor-ventas/{id}',
            array(
                    'uses'=>'VentaController@destroy',
                    'as'=>'mantenedor-ventas.delete'
            ));

    Route::post('/carro', 'TiendaController@post_carro');
    Route::get('/eliminar-producto/{arrayKey}','TiendaController@eliminar_producto');
    Route::get('/sumar-producto/{arrayKey}','TiendaController@sumar_producto');
    Route::get('/restar-producto/{arrayKey}','TiendaController@restar_producto');
    Route::post('/final-compra','TiendaController@final_compra');
    Route::post('/finalizar','TiendaController@finalizar');
    Route::get('/compra', 'TiendaController@compra');
    Route::get('/mis-compras', 'TiendaController@ordenes');
    Route::get('/solicitud/seguimiento/{id}', 'TiendaController@seguimiento');
    Route::get('/mi-cuenta', 'TiendaController@mi_cuenta');
    Route::get('/certificados', 'TiendaController@certificados');
    Route::post('/mi-cuenta/actualizar', 'TiendaController@actualizar');
    Route::post('/mi-cuenta/actualizar-contraseña', 'TiendaController@actualizar_contraseña');
    Route::get('/servicios', 'TiendaController@servicios');
    // Route::get('/productos', 'TiendaController@productos');
    Route::get('/productos','TiendaController@index');

    Route::get('/producto/{id}', 'TiendaController@single_producto');
    Route::get('/producto/{id}/valoracion', 'ProductoController@productoValoracion');
    Route::get('/ver-direcciones/{id}', 'TiendaController@ver_direcciones');
    Route::get('/quitar/{id}', 'DireccionUserController@quitar');
    Route::get('/direccion/edit/{id}', 'DireccionUserController@direccionEdit');
    Route::get('/ver-productos/{id}/categorias', 'TiendaController@productos_categorias');


    Route::get('/buscador','TiendaController@buscador');
    //rutas de administrador de tienda
    Route::middleware('auth')->group(function(){
        Route::prefix('private')->group(function(){
            Route::get('/producto/{id}/valoracion/comentar', 'ProductoController@productoValoracionComentar');
        });


	    Route::prefix('admin')->group(function(){
            Route::get('/ventas','AdminController@index');
	    	Route::post('/venta-corta/create','VentaController@createVentaCorta')->name('venta-corta.create');
            Route::get('/productos','AdminController@producto');
            Route::get('/descargar-trans/pdf/{id}','AdminController@transpdf');
            Route::get('/descargar-ven/pdf/{id}','AdminController@ventapdf');
            Route::get('cambiar-estado/{id}','VentaController@estado')->name('cambiar-estado');
            Route::get('cambiar-estatus/{id}','VentaController@estatus')->name('cambiar-estatus');
            Route::get('cambiar-estatus/transaccion/{id}','VentaController@estatusTransaccion')->name('cambiar-estatus-transaccion');

	    	Route::get('/productos/{id}/descuentos','AdminController@productoDescuentos');

            Route::get('/categorias','AdminController@categoria');
            Route::get('/productos/descuento-activar/{id}','DescuentosController@ActivarDescuento');
            Route::get('/productos/descuento-desactivar/{id}','DescuentosController@DesactivarDescuento');

            Route::get('/mensajes/leido/{id}','MensajeController@Leido');
            Route::get('/mensajes/no-leido/{id}','MensajeController@No_Leido');
            Route::get('/mensajes/respondido/{id}','MensajeController@Respondido');



            Route::get('/marcas','AdminController@marcas');
            Route::get('/descuentos','AdminController@descuentos');
	    	Route::get('/portal','AdminController@portal');
	    	Route::get('/pagos','AdminController@pagos');
	    	Route::get('/banners','AdminController@banner');
	    	//Route::get('/intro','AdminController@intro');
	    	Route::get('/mensajes','AdminController@mensaje');
            Route::get('/review','AdminController@review');
            Route::get('/ocultar-comentarios/{id}','AdminController@ver_mas');
            Route::get('/publicar/{id}','AdminController@publicar');
            Route::get('/desactivar/{id}','AdminController@desactivar');

            //CRUD categoria
            Route::resource('mantenedor-categoria','CategoriasController');
            Route::delete('mantenedor-categoria/{id}',array(
                'uses'=>'CategoriasController@destroy',
                'as'=>'mantenedor-categoria.delete'
            ));
            //CRUD descuentos
            Route::resource('mantenedor-descuento','DescuentosController');
            Route::delete('mantenedor-descuento/{id}',array(
                'uses'=>'DescuentosController@destroy',
                'as'=>'mantenedor-descuento.delete'
            ));
            //CRUD marca
            Route::resource('mantenedor-marca','MarcaController');
            Route::delete('mantenedor-marca/{id}',array(
                'uses'=>'MarcaController@destroy',
                'as'=>'mantenedor-marca.delete'
            ));
                //Crud Producto
	    	Route::resource('mantenedor-producto','ProductoController');
			Route::delete('mantenedor-producto/{id}',
	        array(
	            'uses'=>'ProductoController@destroy',
	            'as'=>'mantenedor-producto.delete'
            ));

	    	Route::resource('mantenedor-banner','BannerController');
			Route::delete('mantenedor-banner/{id}',
	        array(
	            'uses'=>'BannerController@destroy',
	            'as'=>'mantenedor-banner.delete'
            ));
                //Crud Intro
            Route::resource('mantenedor-intro','IntroController');
            Route::delete('mantenedor-intro/{id}',
            array(
                    'uses'=>'IntroController@destroy',
                    'as'=>'mantenedor-intro.delete'
            ));
            //Crud de Comentarios
            Route::resource('mantenedor-comentarios','ComentariosController');
            Route::delete('mantenedor-comentarios/{id}',
            array(
                    'uses'=>'ComentariosController@destroy',
                    'as'=>'mantenedor-comentarios.delete'
            ));
            Route::resource('mantenedor-comentarios','ComentariosController');
            Route::delete('mantenedor-comentarios/{id}',
            array(
                    'uses'=>'ComentariosController@destroy',
                    'as'=>'mantenedor-comentarios.delete'
            ));
            Route::resource('mantenedor-direcciones','DireccionUserController');
            Route::delete('mantenedor-direcciones/{id}',
            array(
                    'uses'=>'DireccionUserController@destroy',
                    'as'=>'mantenedor-direcciones.delete'
            ));
            Route::resource('mantenedor-mensajes','MensajeController');
            Route::delete('mantenedor-mensajes/{id}',
            array(
                    'uses'=>'MensajeController@destroy',
                    'as'=>'mantenedor-mensajes.delete'
            ));

	    });
    });
});
