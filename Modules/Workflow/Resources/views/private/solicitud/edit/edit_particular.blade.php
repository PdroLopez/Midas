@extends('layouts.backend.master')
@section('content')

<style>
     .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
           -moz-appearance:none;
                appearance:none;
    }

    .cc-selector-2 input{
        position:absolute;
        z-index:999;
    }

    .visa{background-image:url('{{asset('/tarjeta.jpg')}}');}
    .mastercard{background-image:url('{{asset('/webpay.jpg')}}');}
    .efectivo{background-image:url('{{asset('/efectivo.png')}}');}

    .cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
    .cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
           -moz-filter: none;
                filter: none;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        width:100px;height:70px;
        -webkit-transition: all 100ms ease-in;
           -moz-transition: all 100ms ease-in;
                transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
           -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
                filter: brightness(1.8) grayscale(1) opacity(.7);
    }
    .drinkcard-cc:hover{
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
           -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
                filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    /* Extras */
/*    a:visited{color:#888}
    a{color:#444;text-decoration:none;}
    p{margin-bottom:.3em;}
    * { font-family:monospace; }*/
    .cc-selector-2 input{ margin: 5px 0 0 12px; }
    .cc-selector-2 label{ margin-left: 7px; }
    span.cc{ color:#6d84b4 }
</style>
{{-- paso son elegir una empresa y luego una direccón.
luego los producctos
luego los accsos
luego agendar  --}}
<!--begin::Container-->
<div class="container">
	<div class="card card-custom card-transparent">
		<div class="card-body p-0">
			<!--begin: Wizard-->
			<div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-state="step-first" data-wizard-clickable="true">
				<!--begin: Wizard Nav-->
				<div class="wizard-nav">
					<div class="wizard-steps">
						<!--begin::Wizard Step 1 Nav-->
						<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
							<div class="wizard-wrapper">
								<div class="wizard-number">1</div>
								<div class="wizard-label">
									<div class="wizard-title">Solicitante</div>
									<div class="wizard-desc">Buscar cliente</div>
								</div>
							</div>
						</div>
						<!--end::Wizard Step 1 Nav-->
						<!--begin::Wizard Step 2 Nav-->
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">2</div>
								<div class="wizard-label">
									<div class="wizard-title">Productos</div>
									<div class="wizard-desc">Datos del producto</div>
								</div>
							</div>
						</div>
						<!--end::Wizard Step 2 Nav-->
						<!--begin::Wizard Step 3 Nav-->
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">3</div>
								<div class="wizard-label">
									<div class="wizard-title">Agendamiento</div>
									<div class="wizard-desc">Horario de retiro</div>
								</div>
							</div>
						</div>
						<!--end::Wizard Step 3 Nav-->
						<!--begin::Wizard Step 4 Nav-->
						<div class="wizard-step" data-wizard-type="step">
							<div class="wizard-wrapper">
								<div class="wizard-number">4</div>
								<div class="wizard-label">
									<div class="wizard-title">Resumen</div>
									<div class="wizard-desc">Resumen de datos</div>
								</div>
							</div>
						</div>
						<!--end::Wizard Step 4 Nav-->
					</div>
				</div>
				<!--end: Wizard Nav-->
				<!--begin: Wizard Body-->
					<div class="card card-custom card-shadowless rounded-top-0">
						<div class="card-body p-0">
							<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
								<div class="col-xl-12 col-xxl-7">
									<!--begin: Wizard Form-->
									<form class="form mt-0 mt-lg-10" id="kt_form" method="post" action="{{ asset('workflow/solicitud/editar-particular') }}" file="true"  enctype="multipart/form-data">
										<!--begin: Wizard Step 1-->
										@csrf
										<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
											<div class="mb-10 font-weight-bold text-dark">Escoga al usuario de la solicitud</div>
											<!--begin::Input-->
										<input type="hidden" name="boleta_id" id="boleta_id" value="{{$boleta->id}}">

											<div class="form-group">
												<label>Usuarios</label>
												<select class="form-control" onchange="usuarioFind(this.value);" name="usuario" id="usuario_find_par">
													<option value="">Seleccionar</option>
													@foreach($user as $usuario)
														@if($boleta->user != null)
															@if($boleta->user->id == $usuario->id)
															<option value="{{ $usuario->id }}" selected>{{ $usuario->name }} {{ $usuario->apellido }}</option>
															@else
															<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
															@endif
														@else
															<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
														@endif
													@endforeach
												</select>
											</div>
											<div class="form-group" id="direcciones">
												@if($boleta->user != null)
												<select class="form-control" name="direccion_usuario" onchange="nuevadireccion(this.value)">
													<option value="">Seleccionar</option>
													@foreach($boleta->user->direccion as $dir)
 														@if($boleta->bk_direcciones_user_id == $dir->id)
														<option value="{{ $dir->id }}" selected>{{ $dir->nombre }}
															@if($dir->comuna != null)
																, {{$dir->comuna->nombre}}
															@endif
															@if($dir->region != null)
																, {{$dir->region->nombre}}.
															@endif
														</option>
														@else
														<option value="{{ $dir->id }}">{{ $dir->nombre }}
															@if($dir->comuna != null)
																, {{$dir->comuna->nombre}}
															@endif
															@if($dir->region != null)
																, {{$dir->region->nombre}}.
															@endif
														</option>
														@endif
													@endforeach
													<option value="otra">Nueva Dirección</option>
												</select>
												@endif
											</div>
										</div>
										<!--end: Wizard Step 1-->
										<!--begin: Wizard Step 2-->
										<div class="pb-5" data-wizard-type="step-content">
											<div class="mb-10 font-weight-bold text-dark">Ingrese el producto</div>
											<!--begin::Input-->

										@include('workflow::private.solicitud.edit.productos_particulares')
										<div class="form-group">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											  Agregar Producto
											</button>
										</div>

											<hr>

											<h5><strong>Lista de productos agregados</strong></h5>

						<table class="table" id="session_datos_particulares">
							<thead>
								<tr>
									<th>Producto</th>
			                        <th>Imagen</th>
			                        <th>Mt3</th>
			                        <th>Peso</th>
			                        <th></th>
								</tr>
							</thead>
							<tbody>
				              <?php 
				                $totalproducto = 0;
				                $mt3 = 0;
				                $mt3_total = 0;
				              ?>
								@if(Session::has('prod_particular'))
					              @foreach(Session::get('prod_particular') as $key => $solicitud)
					                    <?php 
					                        $totalproducto = 29990;
					                        $mt3 = $solicitud['mt3'];
					                        $mt3_total = $mt3_total+$mt3;
					                    ?>
					                    @if($mt3_total > 2)
					                        <?php
					                            $mt3_restante = $mt3_total-2;
					                            $valor_mt3 = ($mt3_restante*29990)/2;
					                            $totalproducto  = $totalproducto+$valor_mt3;
					                        ?>
					                    @endif
									<tr>
										<th>{{$solicitud['residuo']}}</th>
										<th><img src="{{ asset('/storage/'.$solicitud['imagen']) }}" alt="Image de producto" width="100 " height="100"></th>
										<th>{{$solicitud['mt3']}}</th>
										<th>{{$solicitud['peso']}}</th>
										<th><a onclick="borrarproducto('{{$solicitud['id_sol']}}')">X</a></th>
									</tr>
					              @endforeach
					            @else
					            	@if($boleta->solicitudes->count() == 0)
						            	 <tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									@else
										@foreach($boleta->solicitudes as $solicitud)
						                    <?php 
						                        $totalproducto = 29990;
						                        $mt3 = $solicitud->solicitud->mt3;
						                        $mt3_total = $mt3_total+$mt3;
						                    ?>
						                    @if($mt3_total > 2)
						                        <?php
						                            $mt3_restante = $mt3_total-2;
						                            $valor_mt3 = ($mt3_restante*29990)/2;
						                            $totalproducto  = $totalproducto+$valor_mt3;
						                        ?>
						                    @endif
											<tr>
												<th>{{$solicitud->solicitud->residuos->nombre}}</th>
												<th><img src="{{ asset('/storage/'.$solicitud->solicitud->imagen->first()->archivo)}}" alt="Image de producto" width="100 " height="100"></th>
												<th>{{$solicitud->solicitud->mt3}}</th>
												<th>{{$solicitud->solicitud->peso}}</th>
												<th><a onclick="borrarproducto('{{$solicitud->sl_solicitudes_id}}')">X</a></th>
											</tr>
						              	@endforeach
					            	@endif
					            @endif
							</tbody>
						</table>

											<br>
					                        <div class="mb-10 font-weight-bold text-dark">Ingrese el acceso</div>
											<!--begin::Input-->
											<input type="hidden" name="totalproducto" value="{{round($totalproducto)}}" id="totalproducto_id">
											<div class="form-group">
					                            <label>Comentario</label>
					                            <textarea class="form-control" name="comentario" id="comentarioparticular">{{$boleta->solicitudes->first()->solicitud->accesos->comentario}}</textarea>
                                            </div>
					                        <div class="form-group row">
					                        	<div class="col-xl-6">
						                        	<label>Fotos</label>
						                        	<input type="file" name="accesos" multiple class="form-control">
					                        	</div>
					                        	<div class="col-xl-6">
					                        		<img src="{{ asset('/storage/'.$boleta->solicitudes->first()->solicitud->accesos->imagen->first()->url)}}" alt="Image de producto" width="100 " height="100">
					                        	</div>
					                        </div>
										</div>
										<!--end: Wizard Step 2-->
										<!--begin: Wizard Step 3-->
										<div class="pb-5" data-wizard-type="step-content">
											<div class="mb-10 font-weight-bold text-dark">Seleccione horario</div>
											<div class="form-group">
							                    <label for="tiporetiro">Retiro</label>
							                    <select class="form-control" name="tiporetiro" id="tiporetiro">
							                        <option value="" selected>Seleccione</option>
							                        @foreach($horario as $hrs)
							                        	@if($boleta->horarios_id != $hrs->id)
							                            	<option value="{{ $hrs->id }}">{{ $hrs->nombre }}: {{ $hrs->hora }}Hrs (${{ $hrs->precio }})</option>
							                            @else
							                            	<option value="{{ $hrs->id }}" selected>{{ $hrs->nombre }}: {{ $hrs->hora }}Hrs (${{ $hrs->precio }})</option>
							                            @endif
							                        @endforeach
							                    </select>
							                </div>
							                <div class="form-group">
							                    <label for="horario">Horario</label>
							                    <select class="form-control" name="horario" id="horario">
							                        <option value="">Seleccione</option>
							                        @foreach($hr_dia as $hora)
							                        	@if($boleta->horarios_dias_id == $hora->id)
							                            	<option value="{{ $hora->id }}" selected>{{ $hora->nombre }}</option>
							                            @else
							                            	<option value="{{ $hora->id }}">{{ $hora->nombre }}</option>
							                            @endif
							                        @endforeach
							                    </select>
							                </div>
							                <div class="form-group">
							                	<div class="mb-10 font-weight-bold text-dark">Metodo de pago</div>
							                	{{-- <center> --}}
							                  <div class="cc-selector-2">
							                  	@if($boleta->tipo_pago == 'transbank')
							                      	<input type="radio" id="transbank" name="pago" value="transbank" onchange="metodo_pago(this.value)" checked>
							                      	<label class="drinkcard-cc visa" for="visa2"></label>
							                      	<input type="radio" id="efectivo" name="pago" value="efectivo" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc efectivo" for="efectivo"></label>
							                    @elseif($boleta->tipo_pago == 'efectivo')
							                    	<input type="radio" id="transbank" name="pago" value="transbank" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc visa" for="visa2"></label>
							                      	<input type="radio" id="efectivo" name="pago" value="efectivo" onchange="metodo_pago(this.value)" checked>
							                      	<label class="drinkcard-cc efectivo" for="efectivo"></label>
							                    @elseif($boleta->tipo_pago == 'webpay')
							                    	<input type="radio" id="transbank" name="pago" value="transbank" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc visa" for="visa2"></label>
							                      	<input type="radio" id="efectivo" name="pago" value="efectivo" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc efectivo" for="efectivo"></label>
							                      	<input  checked="checked" id="mastercard2" type="radio" name="pago" value="webpay" onclick="cantProducto(this.value)" checked>
                      								<label class="drinkcard-cc mastercard"for="mastercard2"></label>
							                    @else
							                    	<input type="radio" id="transbank" name="pago" value="transbank" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc visa" for="visa2"></label>
							                      	<input type="radio" id="efectivo" name="pago" value="efectivo" onchange="metodo_pago(this.value)">
							                      	<label class="drinkcard-cc efectivo" for="efectivo"></label>
							                    @endif
							                  </div>
							                  {{-- </center> --}}
							                <br>
							                </div>
										</div>
										<!--end: Wizard Step 3-->
										<!--begin: Wizard Step 4-->
										<div class="pb-5" data-wizard-type="step-content">
											<!--begin::Section-->
											<h4 class="mb-10 font-weight-bold text-dark">Resumen de productos</h4>
											<h6 class="font-weight-bolder mb-3">Cliente:</h6>
											<div class="text-dark-50 line-height-lg" id="cliente-user">
												@if($boleta->user != null)
													{{$boleta->user->name}}
												@endif
											</div>
											<div class="separator separator-dashed my-5"></div>
											<!--end::Section-->
											<!--begin::Section-->
											<h6 class="font-weight-bolder mb-3">Productos:</h6>
											<div class="text-dark-50 line-height-lg" id="prod-user">

											<hr>
											<table class="table" id="session_datos_particulares_resumen">
												<thead>
								<tr>
									<th>Producto</th>
			                        <th>Imagen</th>
			                        <th>Mt3</th>
			                        <th>Peso</th>
			                        <th></th>
								</tr>
							</thead>
							<tbody>
				              <?php 
				                $totalproducto = 0;
				                $mt3 = 0;
				                $mt3_total = 0;
				              ?>
								@if(Session::has('prod_particular'))
					              @foreach(Session::get('prod_particular') as $key => $solicitud)
					                    <?php 
					                        $totalproducto = 29990;
					                        $mt3 = $solicitud['mt3'];
					                        $mt3_total = $mt3_total+$mt3;
					                    ?>
					                    @if($mt3_total > 2)
					                        <?php
					                            $mt3_restante = $mt3_total-2;
					                            $valor_mt3 = ($mt3_restante*29990)/2;
					                            $totalproducto  = $totalproducto+$valor_mt3;
					                        ?>
					                    @endif
									<tr>
										<th>{{$solicitud['residuo']}}</th>
										<th><img src="{{ asset('/storage/'.$solicitud['imagen']) }}" alt="Image de producto" width="100 " height="100"></th>
										<th>{{$solicitud['mt3']}}</th>
										<th>{{$solicitud['peso']}}</th>
										<th><a onclick="borrarproducto('{{$solicitud['id_sol']}}')">X</a></th>
									</tr>
					              @endforeach
					            @else
					            	@if($boleta->solicitudes->count() == 0)
						            	 <tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									@else
										@foreach($boleta->solicitudes as $solicitud)
						                    <?php 
						                        $totalproducto = 29990;
						                        $mt3 = $solicitud->solicitud->mt3;
						                        $mt3_total = $mt3_total+$mt3;
						                    ?>
						                    @if($mt3_total > 2)
						                        <?php
						                            $mt3_restante = $mt3_total-2;
						                            $valor_mt3 = ($mt3_restante*29990)/2;
						                            $totalproducto  = $totalproducto+$valor_mt3;
						                        ?>
						                    @endif
											<tr>
												<th>{{$solicitud->solicitud->residuos->nombre}}</th>
												<th><img src="{{ asset('/storage/'.$solicitud->solicitud->imagen->first()->archivo)}}" alt="Image de producto" width="100 " height="100"></th>
												<th>{{$solicitud->solicitud->mt3}}</th>
												<th>{{$solicitud->solicitud->peso}}</th>
												<th><a onclick="borrarproducto('{{$solicitud->sl_solicitudes_id}}')">X</a></th>
											</tr>
						              	@endforeach
					            	@endif
					            @endif
							</tbody>
											</table>
											<hr>

											</div>
											<div class="separator separator-dashed my-5"></div>
											<!--end::Section-->
											<!--begin::Section-->
											<h6 class="font-weight-bolder mb-3">Comentarios:</h6>
											<div class="text-dark-50 line-height-lg" id="comentarios_particular">

											</div>
											<div class="separator separator-dashed my-5"></div>
											<!--end::Section-->
											<!--begin::Section-->
											<h6 class="font-weight-bolder mb-3">Horario:</h6>
											<div class="text-dark-50 line-height-lg" id="hora_user">
												<div>{{$boleta->horario->nombre}}: {{$boleta->horario->hora}} Hrs ${{$boleta->horario->precio}}</div>
												<div>Retiro en: {{$boleta->dia->nombre}}</div>
												<div>Metodo de pago: {{$boleta->tipo_pago}}</div>
											</div>
											<div class="separator separator-dashed my-5"></div>
											<!--end::Section-->
											<!--begin::Section-->
											<h6 class="font-weight-bolder mb-3">Montos:</h6>
											<div class="text-dark-50 line-height-lg" id="montos_user">
												<div>Horario: ${{$boleta->horario->precio}}</div>
												<div>Productos: ${{$boleta->total-$boleta->horario->precio}}</div>
												<div>Total: ${{$boleta->total}}</div>
											</div>
											<!--end::Section-->
										</div>
										<!--end: Wizard Step 4-->
										<!--begin: Wizard Actions-->
										<div class="d-flex justify-content-between border-top mt-5 pt-10">
											<div class="mr-2">
												<button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Atras</button>
											</div>
											<div>
												<button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Actualizar</button>
												<button onclick="SiguienteResumenParticular()" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
											</div>
										</div>
										<!--end: Wizard Actions-->
									</form>
									<!--end: Wizard Form-->
								</div>
							</div>
						</div>
					</div>
				<!--end: Wizard Bpdy-->
			</div>
			<!--end: Wizard-->
		</div>
	</div>
</div>
<!--end::Container-->

@endsection
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

	function SiguienteResumenParticular() {

		 document.getElementById('comentarios_particular').innerHTML = document.getElementById('comentarioparticular').value;

	}

	function borrarproducto(id_sol){
		$.get("{{ asset('/workflow/borrar-producto/edit') }}/"+id_sol,function(data, status) {
			var tabla = `<thead>
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Peso</th>
                        <th>Mt3</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>`;
                for (var i = 0; i < data.length; i++) {
                    tabla += `
                        <tr>
                            <th>${data[i].residuo}</th>
                            <th><img src="{{ asset('/storage/${data[i].imagen}') }}" alt="Image de producto" width="100 " height="100"></th>
                            <th>${data[i].peso}</th>
                            <th>${data[i].mt3}</th>
                            <th><a onclick="borrarproducto('${data[i].id_sol}')">X</a></th>
                        </tr>
                    `;
                }
                tabla += `</tbody>`;
                document.getElementById('session_datos_particulares').innerHTML= tabla;
                document.getElementById('session_datos_particulares_resumen').innerHTML= tabla;
		});
	}

	function usuarioFind(id) {
		$.get("{{ asset('/workflow/get-user') }}/"+id, function(data, status){
			document.getElementById('cliente-user').innerHTML = '<div>'+data.user['name']+' '+data.user['apellido']+'</div>';

			if (data.direccion.length > 0) {
				var select = `<label>Seleccione Direccion</label>
				<select class="form-control" name="direccion_usuario" onchange="nuevadireccion(this.value)">
					<option value="">Seleccione dirección</option>
				`;
				for (var i = 0; i < data.direccion.length; i++) {
					select += `<option value="${data.direccion[i]['id']}">${data.direccion[i]['nombre']}</option>`;
				}
				select += `<option value="otra">Nueva Dirección</option></select>`;
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
	function nuevadireccion(val){
			id = document.getElementById('usuario_find_par').value;
			$.get("{{ asset('/workflow/get-user') }}/"+id, function(data, status){
			document.getElementById('cliente-user').innerHTML = '<div>'+data.user['name']+' '+data.user['apellido']+'</div>';
			if(val == 'otra'){

				var dire = `<label>Seleccione Direccion</label>
				<select class="form-control" name="direccion_usuario" onchange="nuevadireccion(this.value)">
					<option value="">Seleccione dirección</option>
				`;
				for (var i = 0; i < data.direccion.length; i++) {
					dire += `<option value="${data.direccion[i]['id']}">${data.direccion[i]['nombre']}</option>`;
				}

				dire += `<option value="otra" selected >Nueva Dirección</option></select>`;
              	dire += `
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
			}else{
				var dire = `<label>Seleccione Direccion</label>
				<select class="form-control" name="direccion_usuario" onchange="nuevadireccion(this.value)">
					<option value="">Seleccione dirección</option>
				`;
				for (var i = 0; i < data.direccion.length; i++) {
					if(data.direccion[i]['id'] == val){
						dire += `<option value="${data.direccion[i]['id']}" selected>${data.direccion[i]['nombre']}</option>`;
					}else{
						dire += `<option value="${data.direccion[i]['id']}">${data.direccion[i]['nombre']}</option>`;
					}
				}
				dire += `<option value="otra">Nueva Dirección</option></select>`;
			}
			document.getElementById('direcciones').innerHTML = dire;
		});
	}
	function valor_producto() {
		var prod = document.getElementById('producto').value;
		var peso = document.getElementById('peso').value;
		var altura = document.getElementById('altura').value;
		var largo = document.getElementById('largo').value;
		var profundo = document.getElementById('profundo').value;
		$.get("{{ asset('/workflow/get-producto') }}/"+prod, function(data, status) {
			document.getElementById('prod-user').innerHTML = `<div>Producto: ${data['nombre']} $${data['precio']}</div>
				<div>Peso: ${peso} KG</div>
				<div>Altura: ${altura} CM</div>
				<div>Largo: ${largo} CM</div>
				<div>Profundo: ${profundo} CM</div>
			`;
		});
	}
	function metodo_pago(pago) {
		var metodo = '';
		switch(pago){
			case 'efectivo':  metodo="efectivo";
				break;
			case 'transbank': metodo="transbank";
				break;
		}
		var horario = document.getElementById('tiporetiro').value;
		var hor_dia = document.getElementById('horario').value;
		// var prod = document.getElementById('producto').value;
		var totalproducto = document.getElementById('totalproducto_id').value;
		$.get("{{ asset('/workflow/get-horario') }}/"+horario+"/"+hor_dia,function(data, status) {
			document.getElementById('hora_user').innerHTML = `
				<div>${data.horario['nombre']}: ${data.horario['hora']}Hrs $${data.horario['precio']}</div>
				<div>Retiro en: ${data.hr_dia['nombre']}</div>
				<div>Metodo de pago: ${metodo}</div>
			`;
			var total = parseInt(data.horario['precio']) + parseInt(totalproducto);
			document.getElementById('montos_user').innerHTML = `
				<div>Horario: $${data.horario['precio']}</div>
				<div>Productos: $${totalproducto}</div>
				<div>Total: $${total}</div>
			`;
		});

	}
	function region(id) {
		$.get('{{ asset('api/comunas') }}/'+id, function(data, status) {
			var select = `<option value="">Seleccione comuna</option>`;
			for(var i = 0; i < data.length; i++){
                select +=  `<option value="${data[i].id}">${data[i].nombre}</option>`;
			}

			document.getElementById('comunas').innerHTML = select;

		});
	}
</script>

