@extends('layouts.backend.master')
@section('content')

<div class="container">
	<div class="card card-custom {{-- card-transparent --}}">
		<div class="card-header">
        	<h2 class="mt-5">Nuevo Retiro Industrial</h2>
        </div>
		<div class="card-body p-0">
			<div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-state="step-first" data-wizard-clickable="true">
				<div class="wizard-nav">
					<div class="wizard-steps">
						<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
							<div class="wizard-wrapper">
								<div class="wizard-number">1</div>
								<div class="wizard-label">
									<div class="wizard-title">Agregar Empresa</div>
									<div class="wizard-desc">Buscar la empresa</div>
								</div>
							</div>

						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">2</div>
								<div class="wizard-label">
									<div class="wizard-title">Productos</div>
									<div class="wizard-desc">Datos del producto</div>
								</div>
							</div>
						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">3</div>
								<div class="wizard-label">
									<div class="wizard-title">Agendamiento</div>
									<div class="wizard-desc">Hora de despacho</div>
								</div>
							</div>
						</div>
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">4</div>
								<div class="wizard-label">
									<div class="wizard-title">Resumen</div>
									<div class="wizard-desc">Resumen de datos</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-custom card-shadowless rounded-top-0">
					<div class="card-body p-0">
						<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
							<div class="col-xl-12 col-xxl-7">
								<form class="form mt-0 mt-lg-10" id="kt_form" method="post" action="{{ asset('empresa/agregar-solicitud-retiro') }}" file="true"  enctype="multipart/form-data">
									@csrf
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										<div class="mb-10 font-weight-bold text-dark">Escoga la Empresa</div>
										<div class="form-group">
											<label>Empresas</label>
											<select class="form-control" required name="empresa" id="empresa" onchange="obtenerDirecciones(this.value)">
												<option value="">Seleccione..</option>
												@foreach($empresasusuarios as $emp)
													<option name="{{ $emp->empresa->nombre }}" value="{{ $emp->empresa->id }}">{{ $emp->empresa->nombre }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group" id="direcciones">

											</div>
									</div>
									<div class="pb-5" data-wizard-type="step-content">
										<div class="mb-10 font-weight-bold text-dark">Ingrese el producto</div>
										<div class="form-group">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											  Agregar Producto
											</button>
										</div>
										<table class="table" id="session_datos">
											<thead>
												<tr>
													<th>Grupo</th>
													<th>Clasificación</th>
													<th>Comentarios</th>
													<th>Retiro</th>


												</tr>
											</thead>
											<tbody>
												<tr>
													<th></th>
													<th></th>
													<th></th>
													<th></th>

												</tr>
											</tbody>
										</table>
										<br>
										<h5>Accesos</h5>
										<div class="form-group">
											<label>Comentario</label>
											<textarea id=comentario_resumen class="form-control" required  name="comentario"></textarea>
										</div>
										<div class="form-group">
											<label>Imagenes</label>
											<input type="file" name="acceso[]" required  multiple class="form-control">
										</div>
									</div>
									<div class="pb-5" data-wizard-type="step-content">
										<div class="mb-10 font-weight-bold text-dark">¿Retiro por midas?</div>
										<div class="form-group">
						                    <label for="tiporetiro">Retiro</label>
						                    <br>
						                      <input type="radio" id="propio" name="retiro"  value="1">
											  <label for="male">Retiro por medios de la empresa solicitante</label><br>
											  <input type="radio" id="midas" name="retiro" value="2">
											  <label for="female">Retiro de midas</label><br>
						                </div>
									</div>
									<div class="pb-5" data-wizard-type="step-content">
										<h4 class="mb-10 font-weight-bold text-dark">Resumen de productos</h4>
										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Empresa</strong></small></h4>
										<ul class="list-group list-group-flush">
											{{-- <li class="list-group-item">Contratista : <strong><label id="ContratistaResumen">Nombre de la empresa</label></strong></li> --}}
											<li class="list-group-item">Empresa : <strong><label id="EmpresaResumen">Nombre de la empresa</label></strong></li>
											<li class="list-group-item">Dirección : <strong><label id="DireccionResumen">Nombre de la Dirección</label></strong></li>
											
										  </ul>
										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Productos</strong></small></h4>

										
										
										
										
										
										<table class="table" id="session_datos_resumen">
											<thead>
												<tr>
													<th>Grupo</th>
													<th>Clasificación</th>
													<th>Comentarios</th>
													<th>Retiro</th>

												</tr>
											</thead>
											<tbody>
												<tr>
													<th></th>
													<th></th>
													<th></th>
													<th></th>


												</tr>
											</tbody>
										</table>

										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Resumen comentario</strong></small></h4>
											
										<div id="ComentariosResumen"></div>


										<hr>
										<h4 class="mb-10 font-weight-bold text-dark"><small><strong>Retirado por: </strong></small></h4>
										
										<div id="RetiradoporResumen"></div>
										<hr>

									</div>
									<div class="separator separator-dashed my-5"></div>
								</div>
								<div class="d-flex justify-content-between border-top mt-5 pt-10">
									<div class="mr-2">
										<button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Atras</button>
									</div>
									<div>
										<button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Agregar</button>
										<button onclick="SiguienteResumen2()" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="form-group">
				<label>Grupo</label>
				<select class="form-control" required  name="grupo" id="grupo" onchange="clasificaciones(this.value)">
					<option value="">Seleccione un grupo</option>
					@foreach($grupo as $group)
						<option value="{{ $group->id }}">{{ $group->nombre }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Clasifiacion</label>
				<select class="form-control" required  name="clasificacion" id="clasi">
					<option value="">Seleccione clasificacion</option>
				</select>
			</div>
			<div class="form-group">
				<label>Peso y descripción</label>
				<textarea class="form-control" required name="comentario" id="comentario"></textarea>
			</div>
			<div class="form-group">
				<label>Detalle Retiro</label>
				<textarea class="form-control" required name="detalle_retiro" id="detalle_retiro" placeholder="cantidad de Pallet, bolsas etc...">  </textarea>
			</div>
	  </div>
	  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
			<button type="button" class="btn btn-primary" onclick="crear_session()" data-dismiss="modal" >Guardar</button>
	  </div>
    </div>
  </div>
</div>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Hola! No tienes agregada ninguna dirección</h3>
           </div>
           <div class="modal-body">
                Por favor agregue una dirección a la cual debemos retirar los productos
            </div>
           <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
<script>
	//direcciones por empresa
	function obtenerDirecciones(id) {
		$.get("{{ asset('/api/get-direccion') }}/"+id, function(data, status){

			if (data.direccion.length > 0) {
				var select = `<label>Seleccione Direccion</label>
				<select class="form-control" name="direccion_usuario" id="direccion_usuario2">
					<option value="">Seleccione direccion</option>
				`;
				for (var i = 0; i < data.direccion.length; i++) {
					select += `<option value="${data.direccion[i]['id']}">${data.direccion[i]['nombre']}</option>`;
				}
				select += `</select>`;
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
								<option value="">Seleccione region</option>`;
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
								<option value="">Seleccione Comuna</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Dirección</label>
					<input type="text" class="form-control form-control-solid form-control-lg" name="direccion" id="direccion"/>
				</div>`;
				document.getElementById('direcciones').innerHTML = dire;
			}
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
	//clasificacion de producto
	function clasificaciones(id) {
		var select = `<option value="">Seleccione clasificacion</option>`;
		$.get('{{ asset('api/grupo-clasificacion') }}/'+id, function(data, status) {
			for (var i = 0; i < data.length; i++) {
				select += `<option value="${data[i].id}">${data[i].nombre}</option>`;
			}
			document.getElementById('clasi').innerHTML = select;
		});
	}
	//crear session para tomar mas de 1 producto
	function crear_session() {
		var id = document.getElementById('clasi').value;
		if (id != null) {
			var grupo = document.getElementById('grupo').value;
			var emp = document.getElementById('empresa');
			var empresa = emp.options[emp.selectedIndex].text;
			if (grupo != null) {
				var comentario = document.getElementById('comentario').value;
				var detalle_retiro = document.getElementById('detalle_retiro').value;

				if (comentario) {
					
				}else{
					comentario = 'sin comentarios';
				}
				if (detalle_retiro) {
					
				}else{
					detalle_retiro = 'sin comentarios';
				}
				$.get('{{ asset('workflow/session-producto') }}/'+id+"/"+grupo+"/"+comentario+"/"+detalle_retiro, function(data, status) {
					console.log(data);
					var tabla = `<thead>
						<tr>
							<th>Grupo</th>
							<th>Clasificación</th>
							<th>Comentarios</th>
							<th>Retiro</th>


						</tr>
					</thead>
					<tbody>`;
					for (var i = 0; i < data.length; i++) {
						tabla += `
							<tr>
								<th>${data[i].nombre_grupo}</th>
								<th>${data[i].nombre_clasi}</th>
								<th>${data[i].comentario}</th>
								<th>${data[i].detalle_retiro}</th>


							</tr>
						`;
					}
					tabla += `</tbody>`;
					document.getElementById('session_datos').innerHTML= tabla;
					// document.getElementById('resumen').innerHTML= tabla;
					// document.getElementById('empresa-user').innerHTML= empresa;
					document.getElementById('session_datos_resumen').innerHTML= tabla;

				});
			}
		}
	}
	//obtener region
	function region(id) {
		$.get('{{ asset('api/comunas') }}/'+id, function(data, status) {
			var select = `<option value="">Seleccione comuna</option>`;
			for(var i = 0; i < data.length; i++){
                select +=  `<option value="${data[i].id}">${data[i].nombre}</option>`;
			}

			document.getElementById('comunas').innerHTML = select;

		});
	}

	function SiguienteResumen2() {

		
		var retiroResumen ; 
		if ($('input:radio[name=retiro]:checked').val()==2) {
			retiroResumen = "Retiro por Midas";

		}else{
			retiroResumen = "Retiro por Cliente";
		}
		
		 document.getElementById('ComentariosResumen').innerHTML = document.getElementById('comentario_resumen').value;
		 document.getElementById('EmpresaResumen').innerHTML = $('#empresa option:selected').text();
		 document.getElementById('DireccionResumen').innerHTML = $('#direccion_usuario2 option:selected').text();		 
		document.getElementById('RetiradoporResumen').innerHTML = retiroResumen;
      

	}
</script>

