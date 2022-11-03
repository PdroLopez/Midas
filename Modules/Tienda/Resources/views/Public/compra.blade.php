@extends('tienda::layouts.public.master')

@section('tienda::content')
<style type="text/css">
	.wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="done"] .wizard-label .wizard-title, .wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="current"] .wizard-label .wizard-title {
	    color: #8fca00;
	}
	.wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="done"] .wizard-label .wizard-icon, .wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="current"] .wizard-label .wizard-icon {
	    color: #8fca00;
	}
	.wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="done"] .wizard-arrow, .wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step[data-wizard-state="current"] .wizard-arrow {
	    color: #8fca00;
	}
</style>
<style type="text/css">

.card-input-element+.card {
  height: calc(36px + 2*1rem);
  color: var(--primary);
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 2px solid transparent;
  border-radius: 4px;
}

.card-input-element+.card:hover {
  cursor: pointer;
}

.card-input-element:checked+.card {
  border: 2px solid var(--primary);
  -webkit-transition: border .3s;
  -o-transition: border .3s;
  transition: border .3s;
}

@-webkit-keyframes fadeInCheckbox {
  from {
    opacity: 0;
    -webkit-transform: rotateZ(-20deg);
  }
  to {
    opacity: 1;
    -webkit-transform: rotateZ(0deg);
  }
}

@keyframes fadeInCheckbox {
  from {
    opacity: 0;
    transform: rotateZ(-20deg);
  }
  to {
    opacity: 1;
    transform: rotateZ(0deg);
  }
}
</style>
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-custom">
				<div class="card-body p-0">
					<div class="wizard wizard-1" id="kt_wizard_v1" data-wizard-state="step-first" data-wizard-clickable="false">
						<div class="wizard-nav border-bottom">
							<div class="wizard-steps p-8 p-lg-10">
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
									<div class="wizard-label">
										<i class="wizard-icon flaticon-bus-stop"></i>
										<h3 class="wizard-title">1. Direccíón de retiro</h3>
									</div>
									<span class="svg-icon svg-icon-xl wizard-arrow">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<rect fill="#8fca00" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
												<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
											</g>
										</svg>
									</span>
								</div>
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-label">
										<i class="wizard-icon flaticon-list"></i>
										<h3 class="wizard-title">2. Datos personales</h3>
									</div>
									<span class="svg-icon svg-icon-xl wizard-arrow">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
												<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
											</g>
										</svg>
									</span>
								</div>
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-label">
										<span class="svg-icon svg-icon-2x">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50px" height="50px" viewBox="0 0 24 24" version="1.1" style="width: 50px !important;height: 50px !important;">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2" />
													<rect fill="#000000" x="2" y="8" width="20" height="3" />
													<rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1" />
												</g>
											</svg>
										</span>
										<h3 class="wizard-title">3. Método de pago</h3>
									</div>
									<span class="svg-icon svg-icon-xl wizard-arrow">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<rect fill="#8fca00" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
												<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
											</g>
										</svg>
									</span>
								</div>
								<div class="wizard-step" data-wizard-type="step" onclick="siguientecompra()" >
									<div class="wizard-label">
										<i class="wizard-icon flaticon-truck"></i>
										<h3 class="wizard-title">4. Resumen</h3>
									</div>
									<span class="svg-icon svg-icon-xl wizard-arrow last">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
												<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
											</g>
										</svg>
									</span>
								</div>
							</div>
						</div>
						<div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
							<div class="col-xl-12 col-xxl-7">
								<form class="form" id="kt_form" action="{{ asset('tienda/final-compra') }}" method="post" files="true" enctype="multipart/form-data">
									@csrf
									@if(!Auth::check())
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="paso-1">
										<h3 class="mb-10 font-weight-bold text-dark">Indicanos tu dirección</h3>
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group">
													<label>Región</label>
													<select name="regiones" class="form-control form-control-solid form-control-lg" id="regiones" onchange="region(this.value)" required>
														<option value="">Seleccione region</option>
														@foreach($region as $reg)
															<option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group">
													<label>Comuna</label>
													<select name="comunas" class="form-control form-control-solid form-control-lg" id="comunas" required>
														<option value="">Seleccione Comuna</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Dirección</label>
											<input type="text" class="form-control form-control-solid form-control-lg" name="direccion" id="direccion" required onchange="resumen()"/>
											<span class="form-text text-muted">Escribe tu dirección Por favor.</span>
										</div>
										<div class="form-group">
											<label for="regalo">
											  	<input type="checkbox" name="regalo" id="regalo" onclick="mostrarMensaje()">
											  	Enviar como regalo
											</label>
										</div>
										<div id="div-regalo">
										</div>
										<div id="imgregalo">
										</div>
									</div>
										@else
										<div class="pb-5" data-wizard-type="step-content" id="direccion" data-wizard-state="paso1">
                                            <h3 class="mb-10 font-weight-bold text-dark">Seleccione la dirección</h3>
                                                <div class="card"  id="cambio">
                                                {{-- <div class="card-body">
                                                    <p>Región: {{ Auth::user()->direccion->first()->region->nombre }}</p>
                                                    <p>Comuna: {{ Auth::user()->direccion->first()->comuna->nombre }}</p>
                                                    <p>Dirección:  {{ Auth::user()->direccion->first()->nombre }}</p>
                                                </div> --}}

                                                {!! Form::select('mydireccion', $direcciones, null, [ 'class' => 'form-control','id'=>'mydireccion']) !!}

                                                <div align ="right" class="mr-3 mb-2">
                                                    <a style="color: #8fca00; cursor:pointer;" onclick="FormularioDireccion()">Cambiar Dirección o enviar como regalo</a>
                                                </div>
                                                </div>
                                                <div id="otromundo" style="display: none">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Región</label>
                                                                <select name="regiones" class="form-control form-control-solid form-control-lg" id="regiones" onchange="region(this.value)">
                                                                    <option value="">Seleccione region</option>
                                                                    @foreach($region as $reg)
                                                                        <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Comuna</label>
                                                                <select name="comunas" class="form-control form-control-solid form-control-lg" id="comunas">
                                                                    <option value="">Seleccione Comuna</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Dirección</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="direccion" id="direccion" onchange="resumen()"/>
                                                        <span class="form-text text-muted">Escribe tu dirección Por favor.</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="regalo">
                                                            <input type="checkbox" name="regalo" id="regalo" onclick="mostrarMensaje()">
                                                            Enviar como regalo
                                                        </label>
                                                    </div>
                                                    <div id="div-regalo">

                                                    </div>
                                                    <div id="imgregalo">

                                                    </div>
                                                    <div align="right" class="mr-3 mb-2">
                                                    <input style="color: #8fca00; cursor:pointer;" value="Volver" class="btn" type="reset" onclick="FormularioAnterior()"></input>
                                                </div>
                                                </div>
                                            </div>
										@endif
										<script>
                                            function mostrar()
                                            {
                                                document.getElementById('btn-pagar').style.display = 'block';




                                            }
											function FormularioDireccion() {
												document.getElementById('cambio').style.display="none";
												document.getElementById('otromundo').style.display="block";
											}
											function FormularioAnterior() {
												document.getElementById('otromundo').style.display="none";
												document.getElementById('cambio').style.display="block";
												var dire = "";
												var com = "";
												var reg = "";
												var titulo = '<h6 class="font-weight-bolder mb-3">Dirección de Envío:</h6>';

												document.getElementById('direccion_resumen').innerHTML = `
													${titulo}
													<div>Dirección: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->nombre;} ?></div>
													<div>Comuna: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->comuna->nombre;} ?></div>
													<div>Región: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->region->nombre;} ?></div>
												`;

												document.getElementById('direccion_original').innerHTML = ``;


											}
										</script>
										<script>
											function resumen() {
												var dire = document.getElementById('direccion').value;
												var com = document.getElementById('comunas').value;
												var reg = document.getElementById('regiones').value;
												var titulo = '<h6 class="font-weight-bolder mb-3">Dirección de Envío:</h6>';
												$.get("{{ asset('api/region/comuna') }}/"+reg+"/"+com,function(data, status){
													document.getElementById('direccion_resumen').innerHTML = `
														${titulo}
														<div>Dirección: ${dire}</div>
														<div>Comuna: ${data.comuna['nombre']}</div>
														<div>Región: ${data.region['nombre']}</div>
													`;
													document.getElementById('direccion_original').innerHTML = ``;
												});

											}
										</script>
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="paso-2" >
										@if(!Auth::check())
											<h3 class="mb-10 font-weight-bold text-dark">Indicanos tus datos</h3>
											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">
														<label>Nombre</label>
														<input type="text" class="form-control form-control-solid form-control-lg" name="nombre" id="nombre" placeholder="" required />
													</div>
												</div>
												<div class="col-xl-6">
													<div class="form-group">
														<label>Apellido</label>
														<input type="text" class="form-control form-control-solid form-control-lg" name="apellido" id="apellido" placeholder="" required />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-10">
													<div class="form-group">
														<label>Rut</label>
														<input type="number" class="form-control form-control-solid form-control-lg" name="rut" id="rut" placeholder="" onchange="verificarRut()" maxlength="8" required/>
													</div>
												</div>
												<div class="col-2">
													<div class="form-group">
														<label>DV</label>
														<input type="text" class="form-control form-control-solid form-control-lg" name="dv" id="dv" placeholder="" onchange="verificarRut()" maxlength="1" required/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label>Correo</label>
												<input type="email" class="form-control form-control-solid form-control-lg" name="correo" id="correo" placeholder="" required/>
											</div>
											<div class="form-group">
												<label>Teléfono</label>
												<input type="number" class="form-control form-control-solid form-control-lg" name="telefono" id="telefono" placeholder="" required/>
											</div>
										@endif
										@if(Auth::check())
											<h3 class="mb-10 font-weight-bold text-dark">Datos</h3>
											<div class="card">
											  <div class="card-body">
											  	<p>Nombre: {{ Auth::user()->name }}</p>
											  	<p>Correo: {{ Auth::user()->email }}</p>
											  	<p>Telefono: {{ Auth::user()->telefono }}</p>
											  </div>
											</div>
										@endif

									</div>
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="paso-4" >
										<h4 class="mb-10 font-weight-bold text-dark">Selecciona el método de pago</h4>
										<div class="row">
										    <div class="col-md-6">
										      	<input checked="checked" id="webpay" type="radio" name="metododepago" value="webpay" />
										      	<img src="https://www.cl.weber/files/cl/styles/1920x1080/public/pictures/2019-07/webpay.png?itok=K8joDouGjpg" style="width: 200px;">
										    </div>

										  </div>
									</div>
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="pagar"  id="wizard4" >
                                            <div onload="prueba()" style="display: none;"></div>
										<h4 class="mb-10 font-weight-bold text-dark">Revisa tus datos</h4>

										<div class="text-dark-50 line-height-lg" id="direccion_resumen">

										</div>

										<div class="text-dark-50 line-height-lg" id="resumenmydireccion">

										</div>




										{{-- <div class="text-dark-50 line-height-lg" id="direccion_original">
											<h6 class="font-weight-bolder mb-3">Dirección:</h6>
											<div>Dirección: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->nombre;} ?></div>
											<div>Comuna: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->comuna->nombre;} ?></div>
											<div>Región: <?php  if (Auth::check()) { echo Auth::user()->direccion->first()->region->nombre;} ?></div>
										</div> --}}
										<div class="separator separator-dashed my-5"></div>
										<h6 class="font-weight-bolder mb-3">Datos de producto:</h6>
										<div class="text-dark-50 line-height-lg">
											<?php $total = 0; ?>
											@if(Session::has('carro'))
												@foreach(Session::get('carro') as $x)
													<?php $total = $total + $x['precio']*$x['cantidad']; ?>
													<?php
														$numero = (string)$x['precio']* $x['cantidad'];
														$puntos = floor((strlen($numero)-1)/3);
														$tmp = "";
														$pos = 1;
														for($i=strlen($numero)-1; $i>=0; $i--){
														$tmp = $tmp.substr($numero, $i, 1);
														if($pos%3==0 && $pos!=strlen($numero))
														$tmp = $tmp.".";
														$pos = $pos + 1;
														}
														$otraOnda = "$ ".strrev($tmp);
													?>
 													<div>Nombre: {{ $x['nombre'] }}</div>
													<div>Cantidad: {{ $x['cantidad'] }}</div>
													<div>Precio: {{ $otraOnda }}</div>
													<div>Descripción: {!! $x['descripcion'] !!}</div>
												@endforeach
											@endif
										</div>
										<div class="separator separator-dashed my-5"></div>
										<h6 class="font-weight-bolder mb-3">Total</h6>
										<div class="text-dark-50 line-height-lg">
											<div>$ {{ number_format($total) }}</div>
										</div>
									</div>
									<div class="d-flex justify-content-between border-top mt-5 pt-10">
										<div class="mr-2">
											<button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" onclick="ocultar()" data-wizard-type="action-prev">Anterior</button>
										</div>
										<div>
                                            <div id="btn-pagar" style="display: none;">
                                                <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="submit" id="myBtnPagar">Pagar</button>
                                            </div>
											<button onclick="siguientecompra()" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next" id="myBtn">Siguiente</button>
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
@endsection
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Hola! El rut que ingresaste no es valido</h3>
           </div>
           <div class="modal-body">
                Por favor agregue un rut valido
            </div>
           <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
<script>
    function ocultar() {
        document.getElementById('btn-pagar').style.display = 'none';

    }
	function siguientecompra()
    {
        var contador=0;
        document.getElementById('myBtn').onclick = function()
        {
            contador++;

          if (contador == 2)
          {
            document.getElementById('btn-pagar').style.display = 'block';
          }



        }
        document.getElementById('resumenmydireccion').innerHTML = $('#mydireccion option:selected').text();
		var region = "s";//{{ Auth::user()->direccion->first()->region->nombre }};
    }
</script>
<script>
	function verificarRut() {
    var r = document.getElementById('rut').value;
    var dv = document.getElementById('dv').value;
    if (r != '' && dv != '') {
        var rut = r+dv;
        if (rut != '') {
            $.get("{{asset('api/rut-verificar')}}/"+rut, function(data, status) {
                if (data == true) {
                    //alert('Rut correcto');
                    document.getElementById("myBtn").style.display = '';
                }else if(data == false){
                    $(document).ready(function()
                    {
                        $("#mostrarmodal").modal("show");
                    });
                    document.getElementById("myBtn").style.display = "none";
                }
            });
        }
    }
}
</script>
<script>
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
<script>
	function mostrarMensaje(){
		if (document.getElementById('regalo').checked) {
			document.getElementById('div-regalo').innerHTML = `
	       		<h5 class="mb-5">Importante: El despacho del producto se hará en la dirección ingresada arriba</h5>
	       		<div class="form-group">
					<label>Mensaje Especial</label>
					<input type="text" class="form-control form-control-solid form-control-lg" name="nota" id="nota"/>
					<span class="form-text text-muted">Escribe tu nota Por favor.</span>
				</div>
                <div class="form-group">
					<label for="imagen">
					  	<input type="checkbox" name="imagen" id="imagen-regalo" onclick="imagenRegalo()">
					  	¿Desea agregar una imagen con su regalo?
					</label>
				</div>
			`;
		}else{
			document.getElementById('div-regalo').innerHTML = ``;
		}
	}
</script>
<script>
	function imagenRegalo(){
		if (document.getElementById('imagen-regalo').checked) {
			document.getElementById('imgregalo').innerHTML = `
	       		<div class="form-group">
                   <label>Imagen de Regalo</label>
                   <input type="file" name="regaloimagen" class="form-control">
                </div>
			`;
		}else{
			document.getElementById('imgregalo').innerHTML = ``;
		}
	}
</script>
