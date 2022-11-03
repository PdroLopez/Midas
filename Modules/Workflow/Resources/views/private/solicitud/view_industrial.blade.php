@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <!--end::Mobile Toggle-->
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-2 mr-5">Orden de Trabajo #{{ $soli->codigo }}</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->

                @if($soli->empresas_id)
	                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">solicitado por : <strong>{{ $soli->empresas->nombre }}</strong></a>
	                    </li>
	                    @if ($soli->creador != null)
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">creado por : <strong>{{ $soli->creador->name }}</strong></a>
	                    </li>
	                    @endif
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">Día : <strong>{{ $soli->created_at }}</strong></a>
	                    </li>
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">Estado :  &nbsp;<span class="label label-success label-inline"> {{ $soli->estado->nombre }}</span></a>
	                    </li>
	                </ul>
	            @else
	                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                	@if ($soli->users_id != null)
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">solicitado por : <strong>{{ $soli->user->name }}</strong></a>
	                    </li>
	                    @else
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">solicitado por : <strong>{{ $soli->nombre }}</strong></a>
	                    </li>
	                    @endif
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">Día : <strong>{{ $soli->created_at }}</strong></a>
	                    </li>
	                    <li class="breadcrumb-item">
	                        <a href="" class="text-muted">Estado :  &nbsp;<span class="label label-success label-inline"> {{ $soli->estado->nombre }}</span></a>
	                    </li>
	                </ul>
                @endif

                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>

    </div>
</div>
{{-- @if(Session::has('mensaje'))
<div class="col-10 mt-5 mb-0 ml-auto mr-auto alert alert-custom alert-{{ Session::get('mensaje')['type'] }} fade show" role="alert" style="height: 60px;">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    <div class="alert-text">{{ Session::get('mensaje')['content'] }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">{{-- <i class="ki ki-close"></i> </span>
        </button>
    </div>
</div>
@endif
 --}}



<div class="d-flex flex-column-fluid">
                            <!--begin::Container-->

	<div class="container">

	<!--begin::Education-->
		<div class="d-flex flex-row">
			<!--begin::Aside-->
			<div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
				<!--begin::Nav Panel Widget 2-->
				<div class="card card-custom gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<!--begin::Wrapper-->
						<div class="d-flex justify-content-between flex-column pt-4 h-100">
							<!--begin::Container-->
							<div class="pb-5">
								<!--begin::Header-->
								<div class="d-flex flex-column flex-center">
									<div class="symbol symbol-120 symbol-circle symbol-success overflow-hidden">
										<span class="symbol-label">
                                            @foreach ($marcas as  $v)
                                                @if($v->marcas->archivo != null)
                                                    <img src="{{ asset('public/img/archivo/'.$v->marcas->archivo) }}" width="100%" style="h-75 align-self-end">
                                                @else
                                                    <img src="https://www.entel.cl/public/includes/header/img/iconos/svg/logo-entel.svg" class="h-75 align-self-end" alt="">
                                                @endif
                                            @endforeach
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Username-->
									<a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
										@if($soli->empresas_id != null)
											{{ $soli->empresas->nombre }}
										@else
											@if($soli->users_id != null)
												{{ $soli->user->name }}
											@else
												{{$soli->nombre}}
											@endif
										@endif
									</a>
									<!--end::Username-->
									<!--begin::Info-->
									<div class="font-weight-bold text-dark-50 font-size-sm pb-6">
										@if($soli->empresas_id != null)
											{{ $soli->empresas->razon_social }}
										@else
											@if($soli->users_id != null)
												{{ $soli->user->rut }}-{{ $soli->user->dv }}
											@else
												Sin registro
											@endif
										@endif
									</div>
									<!--end::Info-->
								</div>
								<!--end::Header-->
								<!--begin::Body-->
		                        <div class="row">
		                            <div class="d-flex flex-column flex-grow-1 col-12">
										<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Dirección</a>
									</div>
		                           	@if($soli->empresas_id != null)
		                           	@if($soli->bk_direcciones_empresas_id != null)
		                           		@if($soli->direccion_empresa != null)
				                           	<div class="col-12">
											   	@if ($soli->direccion_empresa->bk_regiones_id != null)
													<p>Región: <b>{{ $soli->direccion_empresa->region->nombre}}</b></p>
											   	@else
											   		Sin Región
											  	@endif
				                           	</div>
				                           	<div class="col-12">
				                           		@if ($soli->direccion_empresa->bk_comunas_id != null)
													<p>Comuna: <b>{{ $soli->direccion_empresa->comuna->nombre }}</b></p>
											   	@else
													Sin Comuna
											 	@endif
				                           	</div>
				                           	<div class="col-12">
					                            <p>Calle: <b>{{ $soli->direccion_empresa->nombre }}</b></p>
				                           	</div>
			                           	@endif
	                            	@endif
	                            	@endif
	                            	@if($soli->users_id != null)
	                            	@if($soli->direccion != null)
			                           	<div class="col-12">
										   	@if ($soli->direccion->bk_regiones_id != null)
											   	<p>Región: <b>{{ $soli->direccion->region->nombre }}</b></p>
											@else
											Sin Región
											@endif
			                           	</div>
			                           	<div class="col-12">
										   	@if ($soli->direccion->bk_comunas_id != null)
											   	<p>Comuna: <strong>{{ $soli->direccion->comuna->nombre }}</strong></p>
											@else
											 Sin Comuna
											@endif
			                           	</div>
			                           	<div class="col-12">
										   	@if ($soli->direccion->nombre != null)
											  <p>Calle: <b>{{ $soli->direccion->nombre }}</b></p>
											@else
											Sin Calle
											@endif
		                           		</div>
		                           	@else
		                           		<div class="col-12">
											 <p>Región: <b>Metropolitana de Santiago</b></p>
			                           	</div>
			                           	<div class="col-12">
										   	@if ($soli->comuna_id != null)
											   	<p>Comuna: <b>{{ $soli->comuna->nombre }}</b></p>
											@else
											 Sin Comuna
											@endif
			                           	</div>
			                           	<div class="col-12">
											  <p>Calle: <b>{{ $soli->direccion_rc }} {{ $soli->detalle }}</b></p>
		                           		</div>
	                            	@endif
	                            	@endif
		                        </div>
								<div class="separator separator-solid mt-2 mb-4"></div>
		                        <div class="row">
		                            <ul class="list-unstyled">
		                            @if($soli->empresas_id != null)
		                            	<li>Nombre : <strong> {{ $soli->empresas->nombre }}</strong></li>
			                            <li>Rut : <strong> {{ $soli->empresas->rut }}</strong></li>
			                            @if($soli->empresas->retc != null)
			                            <li>RETC : <strong> {{ $soli->empresas->retc }} </strong></li>
			                            @endif
		                            @else
		                            	@if($soli->users_id)
			                                <li>Nombre : <strong> {{ $soli->user->name }}</strong></li>
			                                <li>Telefono : <strong> {{ $soli->user->telefono }}</strong></li>
			                                <li>Email : <strong> {{ $soli->user->email }} </strong></li>
										@else
										 	<li>Nombre : <strong>{{ $soli->nombre }}</strong></li>
			                                <li>Telefono : <strong> +569 {{ $soli->telefono}} </strong></li>
			                                <li>Email : <strong> {{ $soli->correo }}</strong></li>

		                                @endif
		                            @endif
		                            </ul>
		                        </div>
								<!--end::Body-->
							</div>
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Body-->
				</div>
										<!--end::Nav Panel Widget 2-->
				<div class="card card-custom gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<!--begin::Header-->
						<div class="d-flex align-items-center">

							<div class="d-flex flex-column flex-grow-1">
								<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">AGENDAMIENTO</a>

							</div>
							<!--end::Info-->
							<!--begin::Dropdown-->
							<!--end::Dropdown-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="pt-5">
							<!--begin::Text-->
							 <ul class="list-unstyled">
							    <li>Fecha :
									<strong>
										@if ($soli->fecha_hora != null )
											{{$soli->fecha_hora}}
										@else
											Sin Fecha
										@endif
									</strong>
								</li>
							    <li>Camion :
									 <strong>
										@if ($soli->camiones != null )
											{{$soli->camiones->patente}}
										@else
											Sin Camiones
										@endif
									</strong>
								</li>
							    <li>Chofer :
                                    <strong>
                                        @if ($soli->chofer != null )
											{{$soli->chofer->name}}
										@else
											Sin Chofer
										@endif
                                    </strong>
                                </li>
	                            @if($soli->empresas_id != null)
	                                @if($soli->tipo_servicio_id != null)
	                                   <li>Servicio : <strong> {{ $soli->tipo_servicio->nombre}}</strong></li>
	                                @endif
	                                @if($soli->destino == 0)
	                                    @if($soli->destino_id != null)
	                                    <li>Destino : <strong> {{ $soli->destino_resi->nombre}}</strong></li>
	                                    @endif
	                                @else
	                                	<li>Destino : <strong> Terceros.</strong></li>
	                                @endif
	                                {{-- @if($soli->grua == 0)
	                                	<li>Dispone Grúa Horquilla : <strong>No.</strong></li>
	                                @elseif($soli->grua == 1)
	                                    <li>Dispone Grúa Horquilla : <strong>Si.</strong></li>
	                                @else
	                                	 <li>Dispone Grúa Horquilla : <strong>No Aplica.</strong></li>
	                                @endif
	                                @if($soli->encargado_grua == 0)
	                                	<li>Operario de Carga : <strong>No.</strong></li>
	                                @elseif($soli->encargado_grua == 1)
	                                    <li>Operario de Carga : <strong>Si.</strong></li>
	                                @else
	                                	 <li>Operario de Carga : <strong>No Aplica.</strong></li>
	                                @endif
	                                @if($soli->estacion_camion == 0)
	                                	<li>Estacionamiento para camiones : <strong>No.</strong></li>
	                                @elseif($soli->estacion_camion == 1)
	                                    <li>Estacionamiento para camiones : <strong>Si.</strong></li>
	                                @else
	                                	 <li>Estacionamiento para camiones : <strong>No Aplica.</strong></li>
	                                @endif --}}
	                            @endif
							</ul>
						</div>
					</div>
				</div>
					<div class="card card-custom gutter-b">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="d-flex flex-column flex-grow-1">
								<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">CERTIFICADOS</a>
								{{--<span class="text-muted font-weight-bold">Fecha y asignacion </span>
<span class="text-muted font-weight-bold">Fecha y asignacion </span>--}}
							<div class="row">
{{-- 								<div class="col-6">
									<a  href="{{ asset('workflow/ver/'.$soli->id) }}" class="btn btn-secondary">Ver</a>
								</div> --}}
								<div class="col-6">
									<a   href="{{ asset('workflow/descargar/'.$soli->id) }}" class="btn btn-secondary">Descargar</a>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="flex-row-fluid ml-lg-8">
				<div class="row">
					<div class="col-xxl-6">
						<div class="card card-custom gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">Lista de productos a retirar</span>
								</h3>
							</div>
							<div class="card-body pt-4">
								<div>
								@if($soli->empresas_id)
									@foreach($soli->solicitudes as $productos)
										<div class="d-flex align-items-center mb-8">
											<div class="symbol mr-5 pt-1">
												<div class="symbol-label min-w-65px min-h-100px" ></div>
											</div>
											<div class="d-flex flex-column">
                                                <p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Grupo:
                                                    @if ($productos->solicitud->grupo != null)
                                                        {{ $productos->solicitud->grupo->nombre }}
                                                    @else
                                                        Sin Grupo
                                                    @endif <br></p>
												<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Categoria:
                                                    @if ($productos->solicitud->clasificacion != null)
                                                        {{ $productos->solicitud->clasificacion->nombre }}
                                                    @else
                                                        Sin Categoria

													@endif <br></p>
												<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">SubCategoria:
                                                @if ($productos->solicitud->subcategoria != null)
                                                    {{ $productos->solicitud->subcategoria->nombre }}
                                                @else
                                                    Sin SubCategoria
												@endif <br></p>
												<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Peso:
													{{ $productos->solicitud->peso }} Kg

												<br></p>
												<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Estado:
													@if($productos->solicitud->tipo_producto_id != null)
													{{ $productos->solicitud->tipo_producto->nombre }}
													@else
													{{ $productos->solicitud->otro_estado}}
													@endif
												<br></p>
												@if($productos->solicitud->detalle_retiro != null)
												 <p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Detalles:
													{{ $productos->solicitud->detalle_retiro }}
												  <br></p>
												@endif
												<div>

												{{--	<button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2" data-toggle="modal" data-target="#detalle{{$productos->id}}">Ver</button> --}}
												</div>
											</div>
											<div class="modal fade bd-example-modal-lg" id="detalle{{ $productos->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												  <div class="modal-dialog modal-lg">
												    <div class="modal-content">
												      <div class="modal-header">
												      	<h5>Producto</h5>
												      </div>
												      <div class="modal-body">
												      	<div class="row">
													      	<div class="col-6">
													      		<div class="form-group">
														      		<label>Grupo</label>
														      		<br>
                                                                      {{--
                                                                     {{ $productos->solicitud->grupo->nombre }}

                                                                        --}}
													      		</div>
													      	</div>
													      	<div class="col-6">
													      		<div class="form-group">
														      		<label>Categoria</label>
														      		<br>
                                                                      {{--{{ $productos->solicitud->clasificacion->nombre }}
 --}}
											      		</div>
											      	</div>
											    </div>
											  </div>
											   <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										      </div>
										    </div>
										  </div>
										</div>
									</div>
									@endforeach
								@else
									@foreach($soli->solicitudes as $productos)
									<a class="d-flex align-items-center mb-8" data-toggle="modal" data-target="#detalle{{ $productos->id }}">
										<div class="symbol mr-5 pt-1">
	                                        <div class="symbol-label min-w-65px min-h-100px" style="background-image: url({{ asset($productos->solicitud->imagen->first()->url.'/'.$productos->solicitud->imagen->first()->archivo)}}"></div>
	                                    </div>
										<div class="d-flex flex-column">
											<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><label>Cantidad :</label> {{ $productos->solicitud->cantidad }}<br></p>
											<p class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><label>Mt3 :</label> {{ $productos->solicitud->mt3 }}<br></p>
										</div>
									</a>
									@include('workflow::private.solicitud.view_industrial_modal_pro')
									@endforeach
								@endif
								</div>
								<!--end::Container-->
							</div>
							<!--end::Body-->
						</div>
						<div class="card card-custom gutter-b">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="d-flex flex-column flex-grow-1">
										<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Acceso</a>
										<div class="row">
											<div class="col-12">
												<h5>
												@if ($comentarios[0]->solicitud->accesos_id != null)
													{{$comentarios[0]->solicitud->accesos->comentario}}<br>
												@endif
												
												@if($imagen->count() != 0)
													@foreach ($imagen as $img)
													<br>
														<img src="{{ asset('storage/'.$img->url) }}" width="200px" height="auto">
														<br>
													@endforeach
												@else
												 	Sin fotos adjuntas.
												@endif
												</h5>
											</div>
										</div>
										@if($soli->empresas_id != null)
										<div class="row">
											<div class="col-1"></div>
											<div class="col-11">
					                                @if($soli->grua == 0)
					                                	<li>Dispone Grúa Horquilla : <strong>No.</strong></li>
					                                @elseif($soli->grua == 1)
					                                    <li>Dispone Grúa Horquilla : <strong>Si.</strong></li>
					                                @else
					                                	 <li>Dispone Grúa Horquilla : <strong>No Aplica.</strong></li>
					                                @endif
					                                @if($soli->encargado_grua != null)
					                                	<li>Operario de Carga : <strong>Si - {{$soli->encargado_grua}}</strong></li>
					                                @else
					                                	 <li>Operario de Carga : <strong>No.</strong></li>
					                                @endif
					                                @if($soli->estacion_camion == 0)
					                                	<li>Estacionamiento para camiones : <strong>No.</strong></li>
					                                @elseif($soli->estacion_camion == 1)
					                                    <li>Estacionamiento para camiones : <strong>Si.</strong></li>
					                                @else
					                                	 <li>Estacionamiento para camiones : <strong>No Aplica.</strong></li>
					                                @endif
											</div>
										</div>
										<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Persona Encargada de servicio</a>
										<div class="row">
											<div class="col-1"></div>
											<div class="col-11">
					                            <li>Nombre Contacto : <strong>{{$soli->nombre}}</strong></li>
					                            <li>Teléfono Contacto : <strong>{{$soli->telefono}}</strong></li>
					                            <li>Email Contacto : <strong>{{$soli->correo}}</strong></li>
											</div>
										</div>
					                   @endif
									</div>
								</div>
							</div>
                        </div>
                    </div>
					<div class="col-xxl-6">
                        @if (Auth::user()->roles_id == 15)

                        @elseif(Auth::user()->roles_id == 24)

                        @else
                            <div class="card card-custom gutter-b">
                                <!--begin::Body-->

                                        <div class="card-body">
                                            <!--begin::Top-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Bitacora</span>

                                                </h3>

                                            </div>
                                            {!!Form::open(['route' => 'mantenedor-comentario.store', 'method' => 'POST','files'=>true])!!}
                                            <div class="row">
                                                    @foreach ($bitacora as $bit)
                                                        <div class="col-12">
                                                            <div class="d-flex pt-5">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-40 symbol-light-success mr-5 mt-1">

                                                                        <span class="symbol-label">
                                                                            <img src="/metronic/theme/html/demo1/dist/assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="">
                                                                        </span>



                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex flex-column flex-row-fluid">
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex align-items-center flex-wrap">
                                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder pr-6">{{ $bit->user->name }}</a>


                                                                    </div>

                                                                    <span class="text-dark-75 font-size-sm font-weight-normal pt-1">{{ $bit->comentarios }}</span>
                                                                    <!--end::Info-->
                                                                    <br><hr>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                        </div>

                                                    @endforeach

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control"   placeholder="Ingrese un Comentario" name="comentarios" rows="3"></textarea>
                                                        </div>



                                                    </div>
                                                    {{ Form::hidden('boletas_id',  $bol) }}

                                                    <button class="btn btn-primary">
                                                        Registrar
                                                    </button>

                                                </div>

                                            {!! Form::close() !!}
                                            <!--end::Form-->
                                        </div>


                                    <!--end::Body-->
                            </div>
                        @endif


						<!--begin::Base Table Widget 9-->
						<div class="card card-custom gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">Seguimiento</span>
									<span class="text-muted mt-3 font-weight-bold font-size-sm">Ultimo
									<span class="text-primary">7 mins</span></span>
								</h3>

							</div>
                            <div class="card-body pt-4">
								<div class="timeline timeline-5">
	                                <div class="timeline-items">
	                                    <!--begin::Item-->
	                                    <div class="timeline-item">
	                                        <!--begin::Icon-->
	                                        {{-- @foreach($segui as $seguimiento)
	                                        <div class="timeline-desc timeline-desc-light-primary">
	                                            <span class="font-weight-bolder text-primary">{{ $seguimiento->created_at }}</span>
	                                            <p class="font-weight-normal text-dark-50 pb-2">
	                                                To start a blog, think of a topic about and first brainstorm ways to write details
	                                            </p>
	                                        </div>
	                                        @endforeach --}}
	                                        <!--end::Info-->
	                                    </div>

	                                </div>
	                            </div>
                            </div>
                        </div>

                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center">

                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Observaciones</a>

                                    </div>

                                    <!--end::Info-->
                                    <!--begin::Dropdown-->
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="pt-5">
                                        <a class="btn btn-success"data-toggle="modal" data-target="#edit{{$soli->id}}" href="">Editar Observarciones</a>
                                        @include('workflow::private.solicitud.editar_observacion')
                                    </div>






                                </div>
                            </div>
                            <!--end::Body-->
                        </div>

                    </div>


				</div>
			</div>
			<!--end::Content-->
		</div>
		<!--end::Education-->
	</div>
	<!--end::Container-->
</div>


@endsection

