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

Route::prefix('backend')->group(function() {
    Route::get('/', 'BackendController@index');

    //
    Route::get('region/{id}/comuna', 'MantenedorController@SelectComunas');
    Route::get('/buscar-comuna/{id}', 'ComunasController@BuscarComunas');
    Route::get('servicios', 'MantenedorController@servicioshome');
    Route::resource('private/marcas','MarcasController');
    Route::get('private/marcas/activar/{id}', 'MarcasController@ActivarMarca');
    Route::get('private/marcas/desactivar/{id}', 'MarcasController@DesactivarMarca');

    /*Route::view('private/certificaciones', 'backend::private.certificaciones.index');
    Route::view('private/comunas', 'backend::private.comunas.index');
    Route::view('private/comunidades', 'backend::private.comunidades.index');
    Route::view('private/direccion_empresas', 'backend::private.direccion_empresa.index');
    Route::view('private/direccion_users', 'backend::private.direccion_users.index');
    Route::view('private/estados', 'backend::private.estados.index');
    Route::view('private/pais', 'backend::private.pais.index');
    Route::view('private/programacion', 'backend::private.programacion.index');
    Route::view('private/recursos', 'backend::private.recursos.index');
    Route::view('private/regiones', 'backend::private.regiones.index');
    Route::view('private/tipo_comunidades', 'backend::private.tipo_comunidades.index');*/
            //
    Route::get('private/certificaciones','MantenedorController@certificaciones');
    Route::get('private/comunas','MantenedorController@comunas');
    Route::get('private/comunidades','MantenedorController@comunidades');
    Route::get('private/direccion_empresas','MantenedorController@direccion_empresas');
    Route::get('private/direccion_users','MantenedorController@direccion_users');
    Route::get('private/estados','MantenedorController@estados');
    Route::get('private/pais','MantenedorController@pais');
    Route::get('private/programacion','MantenedorController@programacion');
    Route::get('private/recursos','MantenedorController@recursos');
    Route::get('private/regiones','MantenedorController@regiones');
    Route::get('private/marcas','MantenedorController@marcas');
    Route::get('private/tipo_comunidades','MantenedorController@tipo_comunidades');
    Route::get('private/empresas','EmpresaController@index');
    Route::get('private/chofer/carga','MantenedorController@chofer');
    Route::get('private/despacho','MantenedorController@despacho');
    Route::get('private/cobertura','MantenedorController@cobertura');
    Route::get('private/residuos','MantenedorController@residuos');
    Route::get('private/combo','MantenedorController@combo');
    Route::get('private/destino','MantenedorController@destino');
    Route::get('private/subcategoria','MantenedorController@subcategoria');
    Route::get('private/tipo-producto','MantenedorController@tipo_producto');
    Route::get('private/tipo-servicio','MantenedorController@tipo_servicio');

    Route::get('private/combo/{id}/residuos','MantenedorController@comboresiduos');
    Route::get('private/combo/{id}/activo','ComboController@activarcombo');
    Route::get('private/tipo-producto/cambiar-estado/{id}','TipoProductoController@estado');
    Route::get('private/tipo-servicio/cambiar-estado/{id}','TipoServicioController@estado');
    Route::get('private/destino/cambiar-estado/{id}','TipoServicioController@estado');

    //resumenSMS
    Route::get('private/resumen-sms','ResumenSmsController@index');
    Route::post('private/buscar-date-sms','ResumenSmsController@buscar_date_sms');
    Route::resource('mantenedor-resumen-sms','ResumenSmsController');
        Route::delete('mantenedor-resumen-sms/{id}',array(
            'uses'=>'ResumenSmsController@destroy',
            'as'=>'mantenedor-resumen-sms.delete'
        ));

    //Empresa
    Route::get('private/empresas/{id}/direcciones','EmpresaController@index_direcciones');
    Route::get('private/empresas/{id}/users','EmpresaController@index_users');
    Route::post('private/empresas/users','EmpresaController@postUserEmpresa');
    Route::put('private/editar/user_empresa/{id}','EmpresaController@editUserEmpresa');




    //cambiar estadp empresa
    Route::get('private/cambiar-estado/{id}','EmpresaController@estado');
    Route::get('private/cambiar-estado-desactivar/{id}','EmpresaController@estadodesactivar');
    Route::get('private/desactivar-direccion/{id}','EmpresaController@Desactivar_Direccion');
    Route::get('private/desactivar-direccion-user/{id}','EmpresaController@Desactivar_User');

    //rutas para vista de camiones
    Route::get('private/conductores','TransportesController@conductores');
    Route::get('private/camiones','TransportesController@camiones');
    //CRUD empresa
    Route::post('/agregar-empresa','EmpresaController@store');
    Route::post('/agregar-direccion-empresa/{id}','EmpresaController@agregar_direccion');
    Route::post('/editar-empresa/{id}','EmpresaController@update');
    Route::post('/eliminar-empresa/{id}','EmpresaController@destroy');
            //crud camiones
    Route::resource('mantenedor-camiones','TransportesController');
            // Route::delete('mantenedor-camiones/{id}',array(
            //     'uses'=>'TransportesController@destroy',
            //     'as'=>'mantenedor-camiones.delete'
            // ));
             //crud certificados
    Route::resource('mantenedor-certificados','CertificadosController');
            Route::delete('mantenedor-certificados/{id}',array(
                'uses'=>'CertificadosController@destroy',
                'as'=>'mantenedor-certificados.delete'
            ));
            //Crud Comunas
    Route::resource('mantenedor-comunas','ComunasController');
            Route::delete('mantenedor-comunas/{id}',array(
                'uses'=>'ComunasController@destroy',
                'as'=>'mantenedor-comunas.delete'
            ));
            //Crud Comunidades
    Route::resource('mantenedor-comunidades','ComunidadController');
            Route::delete('mantenedor-comunidades/{id}',array(
                'uses'=>'ComunidadController@destroy',
                'as'=>'mantenedor-comunidades.delete'
            ));
            //Crud Direccion_Empresas
    Route::resource('mantenedor-direccion_empresas','DireccionEmpresaController');
            Route::delete('mantenedor-direccion_empresas/{id}',array(
                'uses'=>'DireccionEmpresaController@destroy',
                'as'=>'mantenedor-direccion_empresas.delete'
            ));

            //CRUD empresa user

            Route::resource('mantenedor-empresas_user','EmpresaUserController');
            Route::delete('mantenedor-empresas_user/{id}',array(
                'uses'=>'EmpresaUserController@destroy',
                'as'=>'mantenedor-empresas_user.delete'
            ));


            //Crud Direccion_Users
    Route::resource('mantenedor-direccion_users','DireccionUserController');
            Route::delete('mantenedor-direccion_users/{id}',array(
                'uses'=>'DireccionUserController@destroy',
                'as'=>'mantenedor-direccion_users.delete'
            ));

            //Crud de Conductores
            Route::resource('mantenedor-conductores','ConductoresController');
            Route::delete('mantenedor-conductores/{id}',array(
                'uses'=>'ConductoresController@destroy',
                'as'=>'mantenedor-conductores.delete'
            ));


            Route::resource('mantenedor-servicios','ServiciosHomeController');
            Route::delete('mantenedor-servicios/{id}',array(
                'uses'=>'ServiciosHomeController@destroy',
                'as'=>'mantenedor-servicios.delete'
            ));


            //Crud Estados
    Route::resource('mantenedor-estados','EstadosController');
            Route::delete('mantenedor-estados/{id}',array(
                'uses'=>'EstadosController@destroy',
                'as'=>'mantenedor-estados.delete'
            ));
            //Crud Pais
    Route::resource('mantenedor-pais','PaisController');
            Route::delete('mantenedor-pais/{id}',array(
                'uses'=>'PaisController@destroy',
                'as'=>'mantenedor-pais.delete'
            ));
            //Crud Programacion
    Route::resource('mantenedor-programacion','ProgramacionController');
            Route::delete('mantenedor-programacion/{id}',array(
                'uses'=>'ProgramacionController@destroy',
                'as'=>'mantenedor-programacion.delete'
            ));
            //Crud Recursos
    Route::resource('mantenedor-recursos','RecursosController');
            Route::delete('mantenedor-recursos/{id}',array(
                'uses'=>'RecursosController@destroy',
                'as'=>'mantenedor-recursos.delete'
            ));
            //CRud Regiones
    Route::resource('mantenedor-regiones','RegionesController');
            Route::delete('mantenedor-regiones/{id}',array(
                'uses'=>'RegionesController@destroy',
                'as'=>'mantenedor-regiones.delete'
            ));
            //crud de marcas

    Route::resource('mantenedor-marcas','MarcasController');
            Route::delete('mantenedor-marcas/{id}',array(
                'uses'=>'MarcasController@destroy',
                'as'=>'mantenedor-marcas.delete'
            ));
        //Crud Tipo de Comunidades
    Route::resource('mantenedor-tipo_comunidades','TipoComunidadesController');
        Route::delete('mantenedor-tipo_comunidades/{id}',array(
            'uses'=>'TipoComunidadesController@destroy',
            'as'=>'mantenedor-tipo_comunidades.delete'
        ));

            //Crud Despacho
    Route::resource('mantenedor-despacho','DespachoController');
        Route::delete('mantenedor-despacho/{id}',array(
            'uses'=>'DespachoController@destroy',
            'as'=>'mantenedor-despacho.delete'
        ));

            //Crud Cobertura
    Route::resource('mantenedor-cobertura','CoberturaController');
        Route::delete('mantenedor-cobertura/{id}',array(
            'uses'=>'CoberturaController@destroy',
            'as'=>'mantenedor-cobertura.delete'
        ));

         //Crud Residuo
    Route::resource('mantenedor-residuos','ResiduosController');
        Route::delete('mantenedor-residuos/{id}',array(
            'uses'=>'ResiduosController@destroy',
            'as'=>'mantenedor-residuos.delete'
        ));

         //Crud Combo
    Route::resource('mantenedor-combo','ComboController');
        Route::delete('mantenedor-combo/{id}',array(
            'uses'=>'ComboController@destroy',
            'as'=>'mantenedor-combo.delete'
        ));

     //Crud Combo Residuo
    Route::resource('mantenedor-combo-residuos','ComboResiduoController');
        Route::delete('mantenedor-combo-residuos/{id}',array(
            'uses'=>'ComboResiduoController@destroy',
            'as'=>'mantenedor-combo-residuos.delete'
        ));

         //Crud Tipo producto
    Route::resource('mantenedor-tipo-producto','TipoProductoController');
        Route::delete('mantenedor-tipo-producto/{id}',array(
            'uses'=>'TipoProductoController@destroy',
            'as'=>'mantenedor-tipo-producto.delete'
        ));
         //Crud tipo servicio
    Route::resource('mantenedor-tipo-servicio','TipoServicioController');
        Route::delete('mantenedor-tipo-servicio/{id}',array(
            'uses'=>'TipoServicioController@destroy',
            'as'=>'mantenedor-tipo-servicio.delete'
        ));

         //Crud Destino
    Route::resource('mantenedor-destino','DestinoController');
        Route::delete('mantenedor-destino/{id}',array(
            'uses'=>'DestinoController@destroy',
            'as'=>'mantenedor-destino.delete'
        ));

         //Crud Subcategoria
    Route::resource('mantenedor-subcategoria','SubCategoriaController');
        Route::delete('mantenedor-subcategoria/{id}',array(
            'uses'=>'SubCategoriaController@destroy',
            'as'=>'mantenedor-subcategoria.delete'
        ));

});
