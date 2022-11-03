@extends('layouts.backend.master')
@section('content')
<div class="container">
	<div class="card card-custom card-transparent">
		<div class="card-body p-0">
			<div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-state="step-first" data-wizard-clickable="true">
				<div class="wizard-nav">
					<div class="wizard-steps">
						<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
							<div class="wizard-wrapper">
								<div class="wizard-number">1</div>
								<div class="wizard-label">
									<div class="wizard-title">Solicitante</div>
									<div class="wizard-desc">Empresas</div>
								</div>
							</div>
						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">2</div>
								<div class="wizard-label">
									<div class="wizard-title">Residuos</div>
									<div class="wizard-desc">Datos de los residuos</div>
								</div>
							</div>
						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">3</div>
								<div class="wizard-label">
									<div class="wizard-title">Agendamiento</div>
									<div class="wizard-desc">Fecha de servicio</div>
								</div>
							</div>
						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">4</div>
								<div class="wizard-label">
									<div class="wizard-title">Resumen</div>
									<div class="wizard-desc">Resumen de solicitud</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-custom card-shadowless rounded-top-0">
					<div class="card-body p-0">
						<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
							<div class="col-xl-12 col-xxl-7">
								<form class="form mt-0 mt-lg-10 " id="kt_form" method="post" action="{{ asset('workflow/agregar-solicitud-empresa') }}" file="true"
								  enctype="multipart/form-data">
									@csrf
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										
										<div class="mb-10 font-weight-bold text-dark">Escoger Empresa</div>
										<div class="form-group">
											<label>Empresa-Cliente</label>
											<select class="form-control select2" id="kt_select2_4" name="empresa" onchange="obtenerDirecciones(this.value)">
												<option value="">Seleccionar</option>
												@if(Session::has('empresa_retiro_industrial'))
												@foreach($empresas as $empre)
													@if($empre->id == Session::get('empresa_retiro_industrial')->id)
														<option value="{{$empre->id}}" selected>{{$empre->nombre}} - {{$empre->rut}}
															@if($empre->retc != null)
															- {{$empre->retc}}
															@endif
															</option>
													@else
														<option value="{{$empre->id}}">{{$empre->nombre}} - {{$empre->rut}}
															@if($empre->retc != null)
															- {{$empre->retc}}
															@endif</option>
													@endif
												@endforeach
												@else
												@foreach($empresas as $empre)
													<option value="{{$empre->id}}">{{$empre->nombre}} - {{$empre->rut}}
														@if($empre->retc != null)
															- {{$empre->retc}}
															@endif</option>
												@endforeach
												@endif
											</select>
										</div>
											<div class="px-0 mt-5 col-6">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-empresa">Agregar Empresa</button>
											</div>
										{{--<div class="form-group" id="data-empresas"></div> --}}
										<br>
										<div class="form-group" id="direcciones">
										@if(Session::has('empresa_retiro_industrial'))
										<input type="hidden" id="empresa" value="{{Session::get('empresa_retiro_industrial')->id}}">
											@if(Session::has('direccion_retiro_industrial'))
												<label>Seleccionar Dirección</label>
												<select class="form-control" name="direccion_usuario" id="direccion_usuario" onchange="cambiarSessionDir(this.value)">
													<option value="">Seleccionar</option>
												@foreach($direcciones_emp->where('empresas_id',Session::get('empresa_retiro_industrial')->id) as $dir_emp)
													@if(Session::get('direccion_retiro_industrial')->id == $dir_emp->id)
														<option value="{{$dir_emp->id}}" selected>{{$dir_emp->nombre}}</option>
													@else
														<option value="{{$dir_emp->id}}">{{$dir_emp->nombre}}</option>

													@endif
													@endforeach
												</select>
												<div class="px-0 mt-5 col-6">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-direccion">Agregar Dirección</button>
											</div>
											@endif
										@else
											<input type="hidden" id="empresa" value="">
										@endif
										</div>
										<div class="mb-10 font-weight-bold text-dark">Tipo de Solicitud</div>
										<div class="form-group">
											<label>Servicio</label>
											<select class="form-control" name="tipo_servicio" id="tipo_ser">
												<option value="">Seleccionar</option>
												@foreach($tipo_servicio as $tiposer)
													<option value="{{ $tiposer->id }}">{{ $tiposer->nombre }}</option>
												@endforeach
											</select>
										</div>
										<div class="mb-10 font-weight-bold text-dark">Destino de Residuos-Carga</div>
										<div class="form-group row">
											<div class="col-5">
												<input type="radio" id="destinomidas" name="destino" value="0" checked onclick="destinoChange(this.value);">
										  		<label>Midas</label><br>
					            				<input type="radio" id="destinoterceros" name="destino" value="1" onclick="destinoChange(this.value);">
										  		<label>Terceros</label><br>
											</div>
											<div class="col-7" id="div_destino_midas" style="display: block;">
											@if(Auth::user()->roles_id == 18)
												<select class="form-control" name="destino_midas" id="dest_midas">
													<option value="">Seleccionar</option>
													@foreach($destinos as $dest)
														<option value="{{ $dest->id }}">{{ $dest->nombre }}</option>
													@endforeach
												</select>
											@endif
											</div>
										</div>
									</div>
									<div class="pb-5" data-wizard-type="step-content">
										<div class="mb-10 font-weight-bold text-dark">Ingrese el residuo</div>
										<div class="form-group">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarproducto">
											  Agregar Residuo
											</button>
										</div>
										<table class="table" id="session_datos">
												<thead>
												<tr>
													<th>Grupo</th>
													<th>Categoria</th>
													<th>Subcategoria</th>
													<th>Estado</th>
													<th>Peso</th>
													<th>Detalle</th>
												</tr>
											</thead>
											<tbody>
												@if(Session::has('prod_industrial'))
													@foreach (Session::get('prod_industrial') as $pro_ind)
														<tr>
															<th>{{$pro_ind['nombre_grupo']}}</th>
															<th>{{$pro_ind['nombre_clasi']}}</th>
															<th>{{$pro_ind['nom_subcate']}}</th>
															<th>{{$pro_ind['nom_tipo_producto']}}</th>
															<th>{{$pro_ind['peso']}} Kg</th>
															<th>{{$pro_ind['detalle_retiro']}}</th>
														</tr>
													@endforeach
												@else
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												@endif
											</tbody>
										</table>
										{{-- <br>
										<div class="form-group">
											<label>Obsevaciones de los productos</label>
											<textarea id="observaciones_id" class="form-control" name="observaciones"></textarea>
										</div> --}}
										<br>
										<h5>Accesos</h5><hr>
										<div class="form-group row">
											<div class="col-4">
												<label>Dispone Grúa Horquilla</label><br>
							            		<input type="radio" id="gruaSi_id" onclick="confirmGrua(this.value);" name="grua" value="1">
												<label>Si</label><br>
							            		<input type="radio" id="gruaNo_id" onclick="confirmGrua(this.value);" name="grua" value="0">
												<label>No</label><br>
							            		<input type="radio" id="gruaNoAplica_id" onclick="confirmGrua(this.value);" name="grua" value="2">
												<label>No Aplica</label><br>
											</div>
											<div class="col-4">
							           	 		<label>Estacionamiento para camiones</label><br>
							            		<input type="radio" id="camionesSi_id" name="esta_camion" value="1">
												<label>Si</label><br>
							            		<input type="radio" id="camionesNo_id" name="esta_camion" value="0">
												<label>No</label><br>
							            		<input type="radio" id="camionesNoAplica_id" name="esta_camion" value="2">
												<label>No Aplica</label><br>
											</div>
											<div class="col-4">
							                    <label>Destrucción Certificada</label><br>
							                    <input type="radio" name="des_certificada" value="0" checked>
							                    <label>Si</label><br>
							                    <input type="radio" name="des_certificada" value="1">
							                    <label>No</label><br>
							                </div>
										</div>
										<div class="form-group row">
											<div class="col-5">
												<label>Operario de Carga</label>
							            		<br>
							            		<input type="radio" id="encargadoSi_id" onclick="operarioGrua(this.value);" name="operario_carga" value="1">
												<label>Si</label><br>
							            		<input type="radio" id="encargadoNo_id" onclick="operarioGrua(this.value);" name="operario_carga" value="0">
												<label>No</label><br>
							            		<input type="radio" id="encargadoNoAplica_id" onclick="operarioGrua(this.value);" name="operario_carga" value="2">
												<label>No Aplica</label><br>
												
											</div>
											<div class="col-7" id="div_encargado_grua" style="display: none;">
												<label>Nombre de Operario</label>
							            		<br>
												<input type="text" name="encargado_grua" class="form-control" id="encargado_grua_id">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-3">
												<label>Fotos Adjuntas</label><br>
							            		<input type="radio" id="adjuntoSi_id" name="adjunto_imagen" value="1" onclick="adjuntoImagen(this.value);">
												<label>Si</label><br>
							            		<input type="radio" id="adjuntoNo_id"  name="adjunto_imagen" value="0" onclick="adjuntoImagen(this.value);">
												<label>No</label><br>
											</div>
											<div class="col-9" id="foto_adjunta_div" style="display: none;">
												<input type="file" name="accesos[]" multiple class="form-control">
											</div>
										</div>
									</div>
									<div class="pb-5" data-wizard-type="step-content">
										<div class="mb-10 font-weight-bold text-dark">Fecha Sugerida de servicio</div>
										<div class="form-group row">
											<div class="col-6">
												<label>Desde</label><br>
							            		<input type="date" id="desdedate_id" class="form-control" name="desde_retiro">
											</div>
											<div class="col-6">
							           	 		<label>Hasta</label><br>
							            		<input type="date" class="form-control" id="hastadate_id" name="hasta_retiro">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5">
												<label>Jornada Estimada de atención</label>
											</div>
											<div class="col-7">
												@foreach($hr_dia as $hr)
								           	 		<input type="radio" name="jornada" value="{{$hr->id}}">
													<label>{{$hr->nombre}}</label>
												@endforeach
							            		<input type="radio" name="jornada" value="0">
												<label>Por Definir</label>
											</div>
										</div>
										<div class="mb-10 font-weight-bold text-dark">Persona Encargada de servicio</div>
										<div class="form-group row">
											<div class="col-5">
												<label>Contacto(Nombre y Apellido)</label>
											</div>
											<div class="col-7">
							            		<input type="text" class="form-control" id="contactonombre_id" name="nombre_contacto" >
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5">
												<label>Móvil de Contacto +56(9)</label>
											</div>
											<div class="col-7">
							            		<input type="number" class="form-control" id="contactotelefono_id" name="telefono_contacto">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5">
												<label>Email(Opcional)</label>
											</div>
											<div class="col-7">
							            		<input type="email" class="form-control" id="contactoemail_id" name="email_contacto">
											</div>
										</div>
										<div class="form-group">
											<label>Obsevaciones(Opcional)</label>
											<textarea id="observaciones_id" class="form-control" name="observaciones"></textarea>
										</div>
									</div>
									{{-- // resumen de los productos  --}}
									<div class="pb-5" data-wizard-type="step-content">
										<h4 class="mb-10 font-weight-bold text-dark">Resumen de Solicitud</h4>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Empresa</strong></small></h4>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Empresa : <strong><label id="EmpresaResumen">Nombre de la empresa</label></strong></li>
											<li class="list-group-item">Dirección : <strong><label id="DireccionResumen">Nombre de la empresa</label></strong></li>
										</ul>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Residuos</strong></small></h4>
										<table class="table" id="session_datos_resumen">
											<thead>
											<tr>
												<th>Grupo</th>
												<th>Categoria</th>
												<th>Subcategoria</th>
												<th>Estado</th>
												<th>Peso</th>
												<th>Detalle</th>
											</tr>
										</thead>
										<tbody>
											@if(Session::has('prod_industrial'))
												@foreach (Session::get('prod_industrial') as $pro_ind)
													<tr>
														<th>{{$pro_ind['nombre_grupo']}}</th>
														<th>{{$pro_ind['nombre_clasi']}}</th>
														<th>{{$pro_ind['nom_subcate']}}</th>
														<th>{{$pro_ind['nom_tipo_producto']}}</th>
														<th>{{$pro_ind['peso']}} Kg</th>
														<th>{{$pro_ind['detalle_retiro']}}</th>
													</tr>
												@endforeach
											@else
												<tr>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
												</tr>
											@endif
										</tbody>
										</table>
										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Datos sobre acceso:</strong></small></h4>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Estacionamiento para camiones: <strong><label id="EstaCamionResumen"></label></strong></li>
											<li class="list-group-item">Destrucción Certificada: <strong><label id="DesCertificadaResumen"></label></strong></li>
											<li class="list-group-item">Dispone Grúa Horquilla: <strong><label id="GruaResumen"></label></strong></li>
											<li class="list-group-item">Operario de Carga:  <strong><label id="OperarioCargaResumen"></label></strong></li>
											<li class="list-group-item"><strong><label id="EncargadoGruaResumen">Sin Operario de Carga</label></strong></li>
											<li class="list-group-item"> Fotos Adjuntas: <strong><label id="FotoAdjuntaResumen"></label></strong></li>
										</ul>
										<hr>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Tipo de Servicio: <strong><label id="TipoServicioResumen"></label></strong></li>
											<li class="list-group-item">Destino de los Residuos-Carga: <strong><label id="DestinadoResumen"></label></strong></li>
											<li class="list-group-item">Horario: <strong><label id="HorarioResumen"></label></strong></li>
											<li class="list-group-item">Obsevaciones: <strong><label id="ObsevacionesResumen"></label></strong></li>
										 </ul>
										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Persona Encargada de servicio:</strong></small></h4>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Nombre Contacto: <strong><label id="NombreResumen"></label></strong></li><li class="list-group-item">Teléfono Contacto: <strong><label id="TelefonoResumen"></label></strong></li><li class="list-group-item">Email Opcional: <strong><label id="CorreoResumen"></label></strong></li>
										 </ul>
										<hr>
									</div>
									<div class="d-flex justify-content-between border-top mt-5 pt-10">
										<div class="mr-2">
											<button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Atras</button>
										</div>
										<div>
											<button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Agregar</button>
											<button onclick="SiguienteResumen()" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@include('workflow::private.solicitud.productos_industrial')
@include('workflow::private.solicitud.crear_empresa')
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>¡Hola! No tienes agregada ninguna dirección</h3>
           </div>
           <div class="modal-body">
                Por favor agregue una dirección.
            </div>
           <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
<div class="modal fade" id="agregar-direccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Agregar Dirección</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form method="post" action="{{ asset('workflow/agregar-nueva-direccion') }}">
				@csrf
      			@if(Session::has('empresa_retiro_industrial'))
      				<input type="hidden" id="empresa_id" name="empresa_id" value="{{Session::get('empresa_retiro_industrial')->id}}">
      			@else
      				<input type="hidden" id="empresa_id" name="empresa_id" value="">
      			@endif
			    <div class="modal-body row">
			    	<div class="col-6">
	                    <div class="form-group">
	                        <label>Región</label>
	                        <select name="bk_regiones_id" id="region_empresa" class="form-control" onchange="selectEmpresa(this.value)">
	                            <option value="">Seleccionar</option>
	                            @foreach($region as $regiones)
	                                <option value="{{ $regiones->id }}">{{ $regiones->nombre }}</option>
	                            @endforeach
	                      </select>
	                    </div>
	                </div>
	                <div class="col-6">
	                    <div class="form-group">
	                        <label>Comuna</label>
	                        <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region">
	                          <option value="">Seleccione una Comuna</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="col-12">
	                    <div class="form-group">
	                        <label>Dirección</label>
	                         {!!Form::text('direccion',null,['class'=>"form-control", 'placeholder'=>"Ingrese una dirección..." , 'required'])!!}
	                    </div>
	                </div>
			    </div>
	      		<div class="modal-footer">
	        		<button class="btn btn-secondary" data-dismiss="modal" type="button">
	                    Cerrar
	                </button>
	                <button class="btn btn-primary">
	                    Registrar
	                </button>
	      		</div>
      		</form>
        </div>

  	</div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!--Material Design Iconic Font-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Image Uploader CSS -->
<link rel="stylesheet" href="dist/image-uploader.min.css">
<!-- Image Uploader Js -->
<script type="text/javascript" src="dist/image-uploader.min.js"></script>

<script>
	function selectEmpresa(id) {
	    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
	        var producto_select = '<option value="">Seleccionar</option>'
	        for (var i = 0; i < data.length; i++)
	            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

	       document.getElementById('comuna_empresa').innerHTML = producto_select;

	    });
	}

	// function confirmGrua(id){
	//     if(id == 1){
	//     	document.getElementById('div_encargado_grua').style.display = "block";
	//     }else{
	//       document.getElementById('div_encargado_grua').style.display = "none";
	//     }
	//  }

	function operarioGrua(id){
	    if(id == 1){
	    	document.getElementById('div_encargado_grua').style.display = "block";
	    }else{
	      	document.getElementById('div_encargado_grua').style.display = "none";
	    }
	}

	 
	 function adjuntoImagen(id){
	    if(id == 1){
	    	document.getElementById('foto_adjunta_div').style.display = "block";
	    }else{
	      document.getElementById('foto_adjunta_div').style.display = "none";
	    }
	 }
	function destinoChange(id){
		if(id == 0){
	    	document.getElementById('div_destino_midas').style.display = "block";
	    }else{
	      	document.getElementById('div_destino_midas').style.display = "none";
	    }
	}

	function SiguienteResumen() {
		// var retiroResumen ;
		// if ($('input:radio[name=retiro]:checked').val()==2) {
		// 	retiroResumen = "Midas";
		// }else{
		// 	retiroResumen = "Empresa solicitante";
		// }

		if ($('input:radio[name=destino]:checked').val()==0) {
			destinoResumen = "Midas ("+$('#dest_midas option:selected').text()+").";
		}else{
			destinoResumen = "Terceros";
		}
		var select = document.querySelector("[name='empresa']");
        var empresaresumen = select.options[select.selectedIndex].innerText;

		if($('input:radio[name=grua]:checked').val()==1){
			var grua = 'Si';
		}else if($('input:radio[name=grua]:checked').val()==0){
			var grua = 'No';
		}else{
			var grua = 'No Aplica';
		}

		if($('input:radio[name=operario_carga]:checked').val()==1){
			var operario_carga = 'Si';
			document.getElementById('EncargadoGruaResumen').innerHTML = 'Nombre operario: '+document.getElementById('encargado_grua_id').value;
		}else if($('input:radio[name=operario_carga]:checked').val()==0){
			var operario_carga = 'No';
		}else{
			var operario_carga = 'No Aplica';
		}

		if($('input:radio[name=esta_camion]:checked').val()==1){
			var esta_camion = 'Si';
		}else if($('input:radio[name=esta_camion]:checked').val()==0){
			var esta_camion = 'No';
		}else{
			var esta_camion = 'No Aplica';
		}

		if($('input:radio[name=adjunto_imagen]:checked').val()==1){
			var foto_adjunta = 'Si';
		}else{
			var foto_adjunta = 'No';
		}

		if($('input:radio[name=jornada]:checked').val()==1){
			var jornadaResumen = 'Mañana';
		}else if($('input:radio[name=jornada]:checked').val()==2){
			var jornadaResumen = 'Tarde';
		}else{
			var jornadaResumen = 'Por definir';
		}

		if($('input:radio[name=des_certificada]:checked').val()==0){
			var des_certificada = 'Si';
		}else if($('input:radio[name=des_certificada]:checked').val()==1){
			var des_certificada = 'No';
		}

		if(document.getElementById('observaciones_id').value == ''){
			observaciones = 'Sin Obsevaciones';
		}else{
			observaciones = document.getElementById('observaciones_id').value;
		}


		// document.getElementById('ComentariosResumen').innerHTML = document.getElementById('comentario_resumen').value;
		// document.getElementById('ContratistaResumen').innerHTML = $('#marca option:selected').text();
		document.getElementById('EmpresaResumen').innerHTML = empresaresumen;
		document.getElementById('DireccionResumen').innerHTML = $('#direccion_usuario option:selected').text();
		document.getElementById('TipoServicioResumen').innerHTML = $('#tipo_ser option:selected').text();
		document.getElementById('GruaResumen').innerHTML = grua;
		
		document.getElementById('OperarioCargaResumen').innerHTML = operario_carga;
		document.getElementById('EstaCamionResumen').innerHTML = esta_camion;
		document.getElementById('FotoAdjuntaResumen').innerHTML = foto_adjunta;
		// document.getElementById('RetiradoporResumen').innerHTML = retiroResumen;
		document.getElementById('DestinadoResumen').innerHTML = destinoResumen;
		document.getElementById('DesCertificadaResumen').innerHTML = des_certificada;
		document.getElementById('HorarioResumen').innerHTML = 'Desde '+document.getElementById('desdedate_id').value+' hasta '+document.getElementById('hastadate_id').value+'. Jornada Estimada '+jornadaResumen;
		document.getElementById('NombreResumen').innerHTML = document.getElementById('contactonombre_id').value;
		document.getElementById('TelefonoResumen').innerHTML = document.getElementById('contactotelefono_id').value;
		document.getElementById('CorreoResumen').innerHTML = document.getElementById('contactoemail_id').value;
		document.getElementById('ObsevacionesResumen').innerHTML = observaciones;

	}
</script>
<script>
	/*function obtenerMarcas(id){
		$.get("{{-- asset('/api/get-marca') --}}/"+id, function(data, status){
			if (data.marcas.length > 0) {
				var select = `<label>Seleccione Marca</label>
				<select class="form-control" name="marca" id="marca-nombre">
					<option value="">Seleccione Marca</option>
				`;
				for (var i = 0; i < data.marcas.length; i++) {
					if (data.marcas[i]['marcas_id'] == data.marca[i]['id']) {
						select += `<option value="${data.marcas[i]['id']}">${data.marca[i]['nombre']}</option>`;
					}
				}
				select += `</select>`;
				document.getElementById('direcciones').innerHTML = select;
			}
		});
		var emp = document.getElementById('empresa');
		var empresa = emp.options[emp.selectedIndex].text;
		document.getElementById('empresa-user').innerHTML= empresa;
	}*/
	function obtenerEmpresas(id){

		$.get("{{ asset('/api/get-empresa') }}/"+id, function(data, status){
			// alert(data.empresas.length);
			var i = 0 ;

			if (data.empresas2.length > 0) {
				var select = `<label>Seleccione Empresa</label>
				<select class="form-control" name="empresa" id="empresa" onchange="obtenerDirecciones(this.value)">
					<option value="">Seleccionar</option>
				`;
				for (var i = 0; i < data.empresas2.length; i++) {
					select += `<option value="${data.empresas2[i]['id']}">${data.empresas2[i]['nombre']}</option>`;
				}
				select += `</select>`;
				document.getElementById('data-empresas').innerHTML = select;
			}
		});
	}
	//direcciones por empresa
	function obtenerDirecciones(id) {
		$("#empresa_id").val(id);
		$.get("{{ asset('/api/get-direccion') }}/"+id, function(data, status){

			if (data.direccion.length > 0) {
				var select = `<label>Seleccione Dirección</label>
				<select class="form-control" name="direccion_usuario" id="direccion_usuario" onchange="cambiarSessionDir(this.value)">
					<option value="">Seleccionar</option>
				`;
				for (var i = 0; i < data.direccion.length; i++) {
					select += `<option value="${data.direccion[i]['id']}">${data.direccion[i]['nombre']}, ${data.direccion[i]['comunas']}, ${data.direccion[i]['regiones']}</option>`;
				}
				select += `</select>`;
				select += `
					<div class="px-0 mt-5 col-6">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-direccion">Agregar Dirección</button>
					</div>
					<input type="hidden" id="empresa" value="">
					`;
				document.getElementById('direcciones').innerHTML = select;
			}else{
				document.getElementById('direcciones').innerHTML = '';

              	$(document).ready(function()
              	{
                 	$("#mostrarmodal").modal("show");
              	});
              	var dire = `
              	<div class="row">
					<div class="col-xl-6">
						<div class="form-group">
							<label>Región</label>
							<select name="regiones" class="form-control form-control-solid form-control-lg" id="regiones" onchange="region(this.value)">
								<option value="">Seleccionar</option>`;
								for (var i = 0; i < data.region.length; i++) {
									dire += `<option value="${data.region[i]['id']}">${data.region[i]['nombre']}</option>`;
								}
				dire +=	`</select>
						</div>
					</div>
					<div class="col-xl-6">
						<div class="form-group">
							<label>Comuna</label>
							<select name="comunas" class="form-control form-control-solid form-control-lg" id="comunas" >
								<option value="">Seleccionar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Dirección</label>
					<input type="text" class="form-control form-control-solid form-control-lg" name="direccion" id="direccion"/>
				</div>
				<input type="hidden" id="empresa" value="">`

				;
				document.getElementById('direcciones').innerHTML = dire;
			}
			$("#empresa").val(id);
		});
	}
	//mostrar datos
	function capturaDatos(id) {
		var empresa = document.getElementById('empresa').value;
		var hora = document.getElementById('tiporetiro').value;
		var productos = '';
		$.get('{{ asset('workflow/datos-solicitados') }}/'+id+'/'+empresa+'/'+hora, function(data, status){
			document.getElementById('empresa-user').innerHTML = `<div>Nombre: ${data.empresas['nombre']}</div>
				<div>Razon social: ${data.empresas['razon_social']}</div>
			`;
			for(var i = 0; i < data.productos.length; i++){
				productos += `<div>Grupo: ${data.productos[i]['nombre_grupo']}</div>
					<div>Clasificación: ${data.productos[i]['nombre_clasi']}</div>
					<br>
				`;
			}
			document.getElementById('resumen').innerHTML = productos;
			document.getElementById('hora_user').innerHTML = `<div>${data.horario['nombre']}: ${data.horario['hora']}Hrs</div>
				<div>Retiro en: ${data.hr_dia['nombre']}</div>`;
		});
	}

	function cambiarSessionDir(id){
		$.get('{{ asset('workflow/cambiar/direccion') }}/'+id, function(data, status) {
		});
	}
	//obtener region
	function region(id) {
		$.get('{{ asset('api/comunas') }}/'+id, function(data, status) {
			var select = `<option value="">Seleccionar</option>`;
			for(var i = 0; i < data.length; i++){
                select +=  `<option value="${data[i].id}">${data[i].nombre}</option>`;
			}
			document.getElementById('comunas').innerHTML = select;

		});
	}
</script>

