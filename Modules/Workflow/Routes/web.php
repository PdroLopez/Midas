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

Route::prefix('workflow')->group(function() {
	//javascript
	Route::get('/get-user/{id}','GestorController@obtener_user');
	Route::get('/get-user-empresa/{id}','GestorController@obtener_user_empresa');
	Route::get('/get-producto/{id}','GestorController@obtener_prod');
	Route::get('/get-horario/{id}/{hor}','GestorController@obtener_hor');
	Route::post('/session-producto','GestorController@Session_Producto');
	Route::post('/session-producto/edit','SolicitudController@edit_Session_Producto');
	Route::post('/session-producto-particular','GestorController@Session_Producto_particular');
	Route::post('/session-producto-particular/edit','SolicitudController@edit_Session_Producto_particular');
	Route::get('/ordenes-trabajo/historial','GestorController@historial');
	Route::get('/borrar-producto/{id_sol}','GestorController@borrarproducto');
	Route::get('/borrar-producto/edit/{id_sol}','SolicitudController@borrarproductoedit');
	Route::get('cambiar/direccion/{id_sol}','GestorController@cambiardirecion');



	Route::get('datos-solicitados/{id}/{empresa}/{hora}','GestorController@obtenerDatos');
    	Route::get('/solicitar-boletas/{id}','GestorController@solicitar_boletas');


    	Route::post('/editar-obs/','GestorController@editar_obs');

	Route::post('/agregar-nueva-direccion','GestorController@nueva_direccion');
	Route::post('edit/agregar-nueva-direccion','SolicitudController@edit_nueva_direccion');

	//filtros
	Route::post('/filtrar-solicitudes','GestorController@filtrar_solicitudes');

	Route::middleware('auth')->group(function(){
	    	Route::get('/', 'SolicitudController@index');//index
	    	Route::get('/me', 'SolicitudController@me');//index
		Route::get('/logistica', 'SolicitudController@solicitudes');//pagina logistica
        	Route::get('/pesajes', 'GestorController@pesa');//pagina logistica

	   	 Route::resource('mantenedor-solicitudes','SolicitudController');//create y update de las solicitudes
	    	Route::get('/gestor','GestorController@index');//pagina gestor
		Route::get('/choferes','ChoferController@index');
		Route::post('/actualizar-boleta/{id}','SolicitudController@actualizar_boleta');
		//estados pedido
		Route::get('/en-proceso/{id}','GestorController@en_proceso');
		Route::get('/cancelar/{id}','GestorController@cancelar');
		Route::post('/comentario-cancelar','GestorController@comentario_cancelar');
		Route::get('/finalizar/{id}','GestorController@finalizar');
		Route::get('/aceptado/{id}','GestorController@aceptado');
		Route::get('/por-despacho/{id}','GestorController@por_despacho');
		Route::get('/aprobacion/{id}','GestorController@sendAprobacion');
		Route::get('/programacion/{id}','GestorController@sendProgramacion');
		Route::get('/en-camion/{id}','GestorController@sendEnCamino');
		Route::get('/retirado/{id}','GestorController@sendRetirado');
		Route::post('/post-retirado/{id}','GestorController@retirado');
        	Route::get('/en-planta/{id}','GestorController@sendEnPlanta');
        	Route::get('/procesar/{id}','GestorController@sendProcesar');
        	Route::get('/control-calidad/{id}','GestorController@sendControlCalidad');
        	Route::get('/en-aprobacion-administrador/{id}','GestorController@sendEnAprobacionAdministrador');

        //reportes
		Route::get('/reportes','ReporteController@index');


		Route::get('/pesaje/{id}','GestorController@viewPesaje');
		Route::post('/pesado','GestorController@Pesado');
		Route::get('modificar/pesaje-residuo/{id}','SolicitudController@ViewModificarPesado');
		Route::post('pesaje/partmodificar','SolicitudController@PartModificarPesado');
		Route::post('pesaje/indumodificar','SolicitudController@InduModificarPesado');
		Route::post('pesaje/partagregar','SolicitudController@AddPartAgregarPesado');
		Route::post('pesaje/induagregar','SolicitudController@AddInduAgregarPesado');
		Route::post('edit-datos-ticket','SolicitudController@EditTicketDatos');
		Route::post('pesaje/edit-ticket','SolicitudController@EditTicketHistorial');
		Route::get('pesaje/edit-ticket/{id}','SolicitudController@ViewEditTicketHistorial');
		Route::put('pesaje/edit-producto/{id}','SolicitudController@EditPesajeProducto')->name('editpesaje.ticket');


		Route::post('/pesaje','GestorController@postPesaje');
		Route::post('/control-calidad','GestorController@postControlCalidad');
		Route::get('/tecnico-empresa','GestorController@tecnico_empresa');
		Route::get('/gerente-operaciones','GestorController@gerente_operaciones');

		//PDF
		Route::get('/ver/{id}','PDFController@verPDF')->name('ver');
		Route::get('/descargar/{id}','PDFController@DescargarPDF')->name('descargar');
		Route::get('/descargar/ticket/{id}','PDFController@DescargarTicketPDF')->name('descargar.ticket');

		//Excel
		Route::get('workflow/export-solicitudes','PDFController@ExcelSolicitud')->name('descargar.excel.solicitud');

		//vistas por estado
		Route::get('datos-aceptados','GestorController@datos_aceptados');
		Route::get('datos-cancelados','GestorController@datos_cancelados');
		Route::get('datos-terminados','GestorController@datos_terminados');
		Route::get('datos-proceso','GestorController@datos_proceso');


		Route::get('/solicitud/view/seguimiento/{id}', 'GestorController@seguimiento');

		//agregar solicitud industrial
		Route::get('/solicitud/create/industrial', 'GestorController@wizard');
		Route::post('/agregar-solicitud-empresa','GestorController@addSoliEmpresa');
    		Route::post('/agregar-empresa-modal','GestorController@postEmpresaModal');

    		//editar industrial
		Route::get('/solicitud/editar/industrial/{id}', 'SolicitudController@editIndustrial');
		Route::post('/solicitud/editar-industrial', 'SolicitudController@PostEditIndustrial');
    		Route::post('/edit/agregar-empresa-modal','SolicitudController@postEmpresaModalEdit');

		//agregar solicitud particular
		Route::get('/solicitud/create/particular', 'GestorController@index');
		Route::post('/agregar-solicitud','GestorController@add_sol');

		//editar particular
		Route::get('/solicitud/editar/particular/{id}', 'SolicitudController@editParticular');
		Route::post('/solicitud/editar-particular', 'SolicitudController@PostEditParticular');

		//CALENDARIO LOGISTICA
		Route::get('/logistica/calendario','GestorController@calendario');
		Route::get('/evento/get','GestorController@get_events');


            //Crud Comentario
        Route::resource('mantenedor-comentario','ComentarController');
        Route::delete('mantenedor-comentario/{id}',array(
                'uses'=>'ComentarController@destroy',
                'as'=>'mantenedor-comentario.delete'
            ));

	});
});
