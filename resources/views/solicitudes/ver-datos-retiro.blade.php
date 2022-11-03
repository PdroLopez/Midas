@extends('layouts.public.master')
@section('content')
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!-- begin::Card-->
		<div class="card card-custom overflow-hidden">
			<div class="card-body p-0">
				<!-- begin: Invoice-->
				<!-- begin: Invoice header-->
				<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
					<div class="col-md-9">
						<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
							<h2 class="display-4 font-weight-boldest mb-10">BOLETA #{{$boleta->id}}<br>
								Código N°{{$boleta->codigo}}<br>
								<h4>@if($boleta->empresas_id != null)
	                     <span class="badge badge-success">Industrial</span>

	                     @else
	                     <span class="badge badge-primary">Particular</span>

	                     @endif</h4>
							</h2>
							<div class="d-flex flex-column align-items-md-end px-0">
								<span class="font-weight-bolder mb-2">DATOS SOLICITANTE</span>
								<span class="d-flex flex-column align-items-md-end opacity-70">
									<span>
										@if($boleta->empresas_id != null)
											{{ $boleta->empresas->nombre }}<br>
											{{ $boleta->empresas->razon_social }}
										@else
											@if($boleta->users_id != null)
												{{ $boleta->user->name }} {{ $boleta->user->apellido }}
											@else
												{{$boleta->nombre}}
											@endif
										@endif
									</span>
									<span>
										@if($boleta->empresas_id == null)
                                @if($boleta->users_id != null)
                                    @if($boleta->direccion != null)
                                        {{ $boleta->direccion->nombre }}
                                    @else
                                        {{ $boleta->direccion_rc}}
                                    @endif
                                @else
                                    {{ $boleta->direccion_rc}}
                                @endif
                            @else
                                @if($boleta->direccion_empresa != null)
                                    {{ $boleta->direccion_empresa->nombre }} 
                                @endif
                            @endif
                            </span>
                            <span>
                            @if($boleta->empresas_id == null)
                                @if($boleta->users_id != null)
                                    @if($boleta->direccion != null)
                                        @if($boleta->direccion->bk_comunas_id != null)
                                           {{ $boleta->direccion->comuna->nombre }},
                                        @endif 
                                        @if($boleta->direccion->bk_regiones_id != null)
                                            {{ $boleta->direccion->region->nombre }}
                                        @endif
                                    @else
                                        @if($boleta->comuna_id != null)
                                           {{ $boleta->comuna->nombre }}, Metropolitana de Santiago.
                                        @endif
                                    @endif
                                @else
                                    @if($boleta->comuna_id != null)
                                       {{ $boleta->comuna->nombre }}, Metropolitana de Santiago.
                                    @endif
                                @endif
                                </strong>
                            @else
                                @if($boleta->direccion_empresa != null)
                                    @if ($boleta->direccion_empresa->bk_comunas_id)
                                        {{ $boleta->direccion_empresa->comuna->nombre }},
                                    @endif
                                     @if($boleta->direccion_empresa->bk_regiones_id != null)
                                        {{ $boleta->direccion_empresa->region->nombre }}
                                    @endif
                                @endif
                                </strong>
                            @endif
                         		</span>
										@if($boleta->users_id)
                                <span>+569 {{ $boleta->user->telefono }}</span>
                                <span>{{ $boleta->user->email }}</span>
										@else
                                <span>+569 {{ $boleta->telefono}} </span>
                                <span> {{ $boleta->correo }}</span>
                             	@endif
								</span>
							</div>
						</div>
						<div class="border-bottom w-100"></div>
						<div class="d-flex justify-content-between pt-6">
							{{-- <div class="d-flex flex-column flex-root">
								<span class="font-weight-bolder mb-2">ESTADO</span>
								<span class="opacity-70">{{$boleta->estado->nombre}}</span>
							</div> --}}
							<div class="d-flex flex-column flex-root">
								<span class="font-weight-bolder mb-2">DETALLES</span>
								<span class="opacity-70">
									Estado: <b>{{$boleta->estado->nombre}}</b><br>
									Fecha Creación: <b>{{$boleta->created_at}}</b>
								</span>
							</div>
							<div class="d-flex flex-column flex-root">
								<span class="font-weight-bolder mb-2">DATOS RETIRO</span>
								<span class="opacity-70">
									@if ($boleta->fecha_hora != null)
                             Fecha Retiro: <b>{{$boleta->fecha_hora}}.</b><br>
                           @else
                              Sin Programar.<br>
                           @endif
                           @if ($boleta->camionero_id != null)
                           	Chofer: <b>{{$boleta->chofer->name}} {{$boleta->chofer->apellido}}</b>.<br> 
                           @else
                              Sin Chofer.<br>
                           @endif
                           @if ($boleta->camiones->tipo_camion != null)
                                    Tipo Vehículo: <b>{{$boleta->camiones->tipo_camion->nombre}}.</b><br> 
                                @else
                                   Sin Tipo Vehiculo.<br> 
                                @endif
                           @if ($boleta->camiones_id != null)
                           	Vehículo: <b>{{$boleta->camiones->patente}}.</b><br> 
                           @else
                              Sin Chofer.<br>
                           @endif
									
	                     </span>
							</div>
							<div class="d-flex flex-column flex-root">
								<span class="font-weight-bolder mb-2"></span>
								<span class="opacity-70">
									<br>
									@if($boleta->empresas_id != null)
                               @if($boleta->tipo_servicio_id != null)
                                   Servicio: <b>{{$boleta->tipo_servicio->nombre}}</b><br>
                               @endif
                               Jornada Estimada:<b>
                               @if($boleta->horarios_dias_id != null)
                                   {{$boleta->dia->nombre}}
                               @else
                                   Por definir 
                               @endif
                               desde {{$boleta->desde}} hasta {{$boleta->hasta}}.</b>
                           @else
                           	Horario: <b>
                               @if($boleta->retiro_propio == null)
                                   @if($boleta->horarios_id && $boleta->horarios_dias_id)
                                   {{ $boleta->dia->nombre }}
                                    en {{ $boleta->horario->hora }}HRS ({{ $boleta->horario->nombre }})
                                    @endif
                                @else
                                   @if($boleta->retiro_propio == 1)
                                       Retiro de la empresa solicitante
                                   @else
                                       Midas realizara el retiro
                                   @endif
                                @endif
                             </b>
                            @endif
                            <br>
                            @if($boleta->venta->count() != 0)
                               Incluye <b>{{$boleta->venta->first()->cantidad}} {{$boleta->venta->first()->producto->nombre}}.</b>
                            @endif
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
					<div class="col-md-9">
						<div class="table-responsive">
							@if($boleta->empresas_id != null)
								<table class="table">
									<thead>
										<tr>
											<th  colspan="2" class="font-weight-bold text-muted text-uppercase">DETALLE ACCESO</th>
											@if($boleta->retiro->count() != 0)
												<th colspan="2" class="font-weight-bold text-muted text-uppercase">RETIRADO</th>
											@endif
										</tr>
									</thead>
									<tbody>
										<tr class="font-weight-bolder">
											<td>
												@if($boleta->grua == 0)
                                                    Dispone Grúa Horquilla : <strong>No.</strong>
                                                @elseif($boleta->grua == 1)
                                                    Dispone Grúa Horquilla : <strong>Si.</strong><br>
                                                    Encargado Grúa Horquilla : <strong>{{$boleta->encargado_grua}}.</strong>
                                                @else
                                                     Dispone Grúa Horquilla : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
                                                @if($boleta->encargado_grua == 0)
                                                    Operario de Carga : <strong>No.</strong>
                                                @elseif($boleta->encargado_grua == 1)
                                                    Operario de Carga : <strong>Si.</strong>
                                                @else
                                                     Operario de Carga : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
                                                @if($boleta->estacion_camion == 0)
                                                    Estacionamiento para camiones : <strong>No.</strong>
                                                @elseif($boleta->estacion_camion == 1)
                                                    Estacionamiento para camiones : <strong>Si.</strong>
                                                @else
                                                     Estacionamiento para camiones : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
{{--                                                 Destrucción Certificada :
                                                @if($boleta->solicitud->destruccion_certificada == 0)
                                                   <strong>Si.</strong>
                                                @else
                                                   <strong>No.</strong>
                                                @endif 
                                                <br> --}}
											</td>
											@if($boleta->retiro->count() != 0)
												<td>
	                                 				@if($boleta->retiro->first()->archivo != null)
	                                 				<img style="width: 150px" src="{{ asset('storage/'.$boleta->retiro->first()->archivo)}}"></img>
	                                 				@endif
	                                 			</td>
												<td>{{ $boleta->observacion_retirado}}</td>
											@endif
										</tr>
									</tbody>
								</table>
							@else
								<table class="table">
									<thead>
										<tr>
											<th  colspan="2" class="font-weight-bold text-muted text-uppercase">ACCESOS</th>
											<th class="font-weight-bold text-muted text-uppercase">DATOS PAGO</th>
											@if($boleta->retiro->count() != 0)
												<th colspan="2" class="font-weight-bold text-muted text-uppercase">RETIRADO</th>
											@endif
										</tr>
									</thead>
									<tbody>
										<tr class="font-weight-bolder">
											@if($boleta->solicitudes->first()->solicitud->accesos_id != null)
												<td>
													@foreach($boleta->solicitudes->first()->solicitud->accesos->imagen as $img_acc)
					                                    <img style="width: 150px" src="{{ asset('storage/'.$img_acc->url)}}"></img>
					                                @endforeach
					                            </td>
					                            <td>{{ $boleta->solicitudes->first()->solicitud->accesos->comentario}}</td>
											@else
												<td>El Usuario no ingreso ningun dato sobre el Acceso</td>
											@endif
											<td>
												Tipo Pago: {{$boleta->tipo_pago}}<br>
												Total Retiro: ${{$boleta->total}}
											</td>
											@if($boleta->retiro->count() != 0)
												<td>
													@if($boleta->retiro->first()->archivo != null)
	                                 				<img style="width: 150px" src="{{ asset('storage/'.$boleta->retiro->first()->archivo)}}"></img>
	                                 				@endif
	                                 			</td>
												<td>{{ $boleta->observacion_retirado}}</td>
											@endif
										</tr>
									</tbody>
								</table>
							@endif
						</div>
					</div>
				</div>
				<!-- end: Invoice header-->
				<!-- begin: Invoice body-->
				<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
					<div class="col-md-9">
						<div class="table-responsive">
							@if($boleta->empresas_id == null)
							<table class="table">
								<thead>
									<tr>
										<th class="pl-0 font-weight-bold text-muted text-uppercase">Producto</th>
										<th colspan="3" class="text-right font-weight-bold text-muted text-uppercase">Detalle</th>
										<th class="text-right font-weight-bold text-muted text-uppercase">Cantidad</th>
									</tr>
								</thead>
								<tbody>
									@foreach($boleta->solicitudes as $solicitudes)
										<tr class="font-weight-boldest">
											<td class="pl-0 pt-7">
												@if($solicitudes->solicitud->Residuos_id != null )
                                        {{ $solicitudes->solicitud->residuos->nombre }}
                                    @else
                                        {{ $solicitudes->solicitud->nombre }}
                                    @endif
                                </td>
											<td class="text-right pt-7">
												<img style="width: 100px" src="{{ asset($solicitudes->solicitud->imagen->pluck('url')->first().'/'.$solicitudes->solicitud->imagen->pluck('archivo')->first())}}"></img>
											</td>
											<td class="text-right pt-7">
                                       Altura: {{$solicitudes->solicitud->altura}} cm<br>
                                       Largo: {{$solicitudes->solicitud->largo}} cm<br>
                                       Profundidad: {{$solicitudes->solicitud->profundidad}} cm<br>
											</td>
											<td class="text-right pt-7">
													Peso: {{$solicitudes->solicitud->peso}} Kg<br>
                                       Mt3: {{$solicitudes->solicitud->mt3}}
											</td>
											<td class="text-right pt-7">
												{{ $solicitudes->solicitud->cantidad }}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							@else
							<table class="table">
								<thead>
									<tr>
										<th class="pl-0 font-weight-bold text-muted text-uppercase">Grupo</th>
	                                    <th class="text-right font-weight-bold text-muted text-uppercase">Categoria</th>
	                                    <th class="text-right font-weight-bold text-muted text-uppercase">SubCategoria</th>
	                                    <th class="text-right font-weight-bold text-muted text-uppercase">Peso</th>
	                                    <th class="text-right font-weight-bold text-muted text-uppercase">Estado</th>
	                                    <th class="text-right font-weight-bold text-muted text-uppercase">Detalles</th>
									</tr>
								</thead>
								<tbody>
									@foreach($boleta->solicitudes as $solicitudes)
										<tr>
                                    <td class="d-flex align-items-center font-weight-bolder">
                                        <a href="#" class="text-dark text-hover-primary">{{ $solicitudes->solicitud->grupo->nombre }}</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->clasificacion != null)
                                                {{ $solicitudes->solicitud->clasificacion->nombre }}
                                            @else
                                                Sin Categoria
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->subcategoria != null)
                                                {{ $solicitudes->solicitud->subcategoria->nombre }}
                                            @else
                                                Sin SubCategoria
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">{{ $solicitudes->solicitud->peso }}</span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->tipo_producto_id != null)
                                            {{ $solicitudes->solicitud->tipo_producto->nombre }}
                                            @else
                                            {{ $solicitudes->solicitud->otro_estado}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            
                                            {{ $solicitudes->solicitud->detalle_retiro }}
                                        </span>
                                    </td>
                                </tr>
									@endforeach
								</tbody>
							</table>
							@endif
						</div>
					</div>
				</div>
				<!-- end: Invoice body-->
				<!-- begin: Invoice footer-->
				
				<!-- end: Invoice footer-->
				<!-- begin: Invoice action-->
				<!-- end: Invoice action-->
				<!-- end: Invoice-->
			</div>
		</div>
		<!-- end::Card-->
	</div>
	<!--end::Container-->
</div>
@endsection