<?php

Route::view('/index-midas', 'index-midas');
Route::view('/index-midas2', 'index-midas2');
Route::view('/prueba', 'prueba');
Route::view('/mail', 'mail');
Route::view('/comprobante', 'comprobante');
Route::view('/certificadoprueba', 'certificadoprueba');

Route::view('/index-midas3', 'index-midas3');
Route::get('/url/movil','RedireccionController@redirect');
Route::get('p/{id}','SitesController@pdfventasi');
Route::get('sp/{id}','SitesController@pdfventasisp');
Route::get('p/descarga/{id}','SitesController@pdfventa');
Route::get('sp/descarga/{id}','SitesController@pdfventasp');

Route::get('p/descarga/{id}','SitesController@pdfventa');
Route::get('beneficio/adidas','SitesController@beneficio_adidas');
Route::get('beneficio/adidas/paso-1','SitesController@beneficio_adidas_paso1');

//retiro corto particular.
Route::get('/retiro','RetiroCortoController@RetiroCortoPaso1');
Route::get('/retiro-corto/buscar-comuna/{id}','RetiroCortoController@BuscarComuna');
Route::post('recopilar/datos/retiro','RetiroCortoController@RecopilarDatos');
Route::get('/retiro-corto/paso-2','RetiroCortoController@RetiroCortoPaso2');
Route::post('retiro-corto/agregar-producto','RetiroCortoController@AgregarProductoRC');
Route::post('retiro-corto/elegir-combo','RetiroCortoController@ElegirComboRC');
Route::get('/retiro-corto/paso-3','RetiroCortoController@RetiroCortoPaso3');
Route::post('retiro-corto/agregar-acceso','RetiroCortoController@AgregarAccesoRC');
Route::get('/retiro-corto/paso-4','RetiroCortoController@RetiroCortoPaso4');
Route::post('retiro-corto/agregar-tiporetiro','RetiroCortoController@AgregarTipoRetiroRC');
Route::get('/retiro-corto/paso-5','RetiroCortoController@RetiroCortoPaso5');
Route::post('retiro-corto/agregar-solicitudrc','RetiroCortoController@AgregarSolicitudRC');
Route::get('/retiro-corto/paso-6','RetiroCortoController@RetiroCortoPaso6');
Route::get('/retiro-corto/cancelar','RetiroCortoController@CancelarRC');
Route::get('/retiro-corto/cancelar/{id}','RetiroCortoController@CancelarRCPaso6');
Route::get('/retiro/corto/final-compra/{id}','RetiroCortoController@RetiroCortoPagoSP');
Route::get('/borrar/sol/rc/{id}','RetiroCortoController@BorrarSolRC');
Route::get('/borrar/combo/rc/{id}','RetiroCortoController@BorrarComboRC');
Route::get('/ver/datos/bol/{code}','QrCodeController@BoletaVerQR');
Route::get('/generar/qr/bol/{id}','QrCodeController@BoletaQR');



Route::get('prueba-pdf','QrCodeController@pdf');
Route::group(['middleware' => 'web'], function(){
	Route::get('/','SitesController@index');
	Route::get('/comunidades','SitesController@comunidades');
	Route::get('/educacion','SitesController@educacion');
	Route::get('/noticias','SitesController@noticias');
	Route::get('/noticias/{slug}','SitesController@noticia_single');
	Route::get('/midas','SitesController@empresa');
	//verificar
	Route::get('verficar-reciclaje','SitesController@qrcode');
	Route::post('verificar-codigo','QrCodeController@buscar_code');
	//
	Route::get('/crear-comunidad','SitesController@paso_1');
	//Route::get('/crear-comunidad/paso-2','SitesController@paso_2');
	//Route::get('/crear-comunidad/paso-3','SitesController@paso_3');
	Route::get('/crear-comunidad/{nombre}','SitesController@paso_4');
	//
    Route::get('/faq','SitesController@faq');
    Route::post('comunidad','SitesController@agregar')->name('comunidad');
    Route::delete('comunidad/{id}',array(
        'uses'=>'SitesController@destroy',
        'as'=>'comunidad.delete'
	));
	Route::view('/pdf','pdf');
	Route::get('/DescargarPDF','PDFController@pdf')->name('DescargarPDF');

	Route::middleware('auth')->group(function(){
		Route::get('/solicitud-paso-1','SitesController@solicitud_paso_1');//agregar producto home
		Route::get('/agregar-producto','SitesController@agregar_producto');//agregar producto
		Route::post('/agregar-producto','SitesController@post_agregar_producto');

        Route::get('/agregar-acceso','SitesController@agregar_acceso');//agregar Acceso
        Route::get('/mis-direcciones/{id}','SitesController@mis_direcciones');//agregar Acceso
        Route::get('/mis-comunidades/{id}','SitesController@mis_comunidades');//agregar Acceso
        Route::get('/quitar/{id}', 'SitesController@quitar');
        Route::get('/direccion/edit/{id}', 'SitesController@direccionEdit');

        Route::resource('mantenedor-direcciones','DireccionUserController');
        Route::delete('mantenedor-direcciones/{id}',
        array(
                'uses'=>'DireccionUserController@destroy',
                'as'=>'mantenedor-direcciones.delete'
        ));


		Route::post('/agregar-acceso','SitesController@post_agregar_acceso');//agregar Acceso




		Route::get('/solicitud-paso-2','SitesController@solicitud_paso_2');//confirmar retiro
		Route::get('/solicitud-paso-3','SitesController@solicitud_paso_3');//agendar hora

		Route::get('/agregar-direccion','SitesController@agregar_direccion');//vista agregar Direccion
		Route::post('/agregar-direccion','SitesController@post_agregar_direccion');//agregar Direccion


		Route::post('/solicitud-paso-4','SitesController@solicitud_paso_4');//resumen y pago
		Route::get('/pago-solicitud-exitosa','SitesController@solicitud_exitosa');//pago exitoso
		Route::get('/pago-solicitud-error','SitesController@solicitud_error');//pago error
		Route::get('/finalizar-pago','SitesController@finalizar_pago');//fin de pago
		Route::get('/pago-solicitud-cancelado','SitesController@solicitud_cancelado'); //cancelar solciitud
		Route::get('/eliminar-producto/{arrayKey}','SitesController@eliminar_producto');
		Route::get('/eliminar-acceso/{arrayKey}','SitesController@eliminar_acceso');
		Route::get('/eliminar-producto-industrial/{arrayKey}','SitesController@eliminar_producto_industrial');

		//SOLICITUDES USUARIOS EMPRESA Y TERCERO
		Route::get('/empresa/solicitud-retiro','SitesController@retiro_industrial_empresa');
		Route::get('/empresa/agregar-solicitud-retiro','SitesController@agregar_retiro_industrial_empresa');
		Route::post('/empresa/agregar-solicitud-retiro','SitesController@add_solicitud_empresa');
		Route::get('/empresa/reporteria','SitesController@reporteria_empresa');
		Route::get('/empresa/mis-certificados','SitesController@certificados_empresa');
        Route::get('/empresa/mis-certificados','SitesController@certificados_empresa');
		Route::get('/tercero/solicitud-retiro','SitesController@retiro_industrial_tercero');
		Route::get('/tercero/reporteria','SitesController@reporteria_tercero');
		Route::get('/empresa/descargar-pdf/{id}','SitesController@descargar_pdf');
		Route::get('private/buscar-camion/{id}','SitesController@buscarCamion');

		

	});
	//estan afuera ya que no se si ajax toma la misma session de laravel
	Route::post('/dropzone-prueba','SitesController@dropzone')->name('dropzone');//guardado de imagen asincronico
	Route::post('/dropzone-industrial','SitesController@dropzone_industrial')->name('dropzone-industrial');//guardado de imagen asincronico
	Route::post('/imagen-acceso','SitesController@img_acceso')->name('img-acceso'); //guardado de imagen asincronico
	//CHOFER
	Route::group(['middleware' => 'role:Chofer'], function(){
		Route::get('/private/chofer','SitesController@chofer_home');
		Route::get('/private/chofer/detalle-retiro/{id}','SitesController@detalle');
		Route::get('/private/chofer/detalle-producto/{id}','SitesController@detalle_producto');
		Route::get('/private/chofer/recibido/{id}','SitesController@recibido');
		Route::post('/private/chofer/retirado/{id}','SitesController@retirado');
		Route::post('/private/chofer/cancelado/{id}','SitesController@cancelado');
	});
	//
	Route::get('/solicitud-retiro-industrial-1','SitesController@retiro_industrial_1');//retiro industrial
	Route::get('/solicitud-retiro-industrial-2','SitesController@retiro_industrial_2');//retiro industrial
	Route::get('/solicitud-retiro-industrial-3','SitesController@retiro_industrial_3');//retiro industrial
	Route::get('/solicitud-retiro-industrial-exito','SitesController@retiro_industrial_exito');//retiro industrial
	Route::get('/solicitud-retiro-industrial-error','SitesController@retiro_industrial_error');//retiro industrial
	Route::get('/agregar-productos-industriales','SitesController@agregar_productos_industriales');//agregar producto insdustrial
	Route::post('/agregar-productos-industriales','SitesController@post_agregar_productos_industriales');
	Route::get('/finalizar-solicitud-industrial','SitesController@finalizar_solicitud_industrial');



	Route::group(['middleware' => ['auth','modules_nav'], 'prefix' => 'private'], function(){



		// home de los perfiles autenticado

		Route::view('me', 'private.me.me');

		//link principal se debe redireccionar desde este controlador
	   Route::get('/','HomeController@index');
	   Route::get('usar-modulo/{id}','HomeController@usar_modulo');


		Route::group(['middleware' => 'role:SuperAdmin'], function(){

		});

	});
});

