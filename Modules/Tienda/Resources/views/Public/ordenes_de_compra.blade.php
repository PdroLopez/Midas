@extends('tienda::layouts.public.master')

@section('tienda::content')
	<style type="text/css">
		.dt-buttons{
			display: none;
		}
		.table.table-head-custom thead tr, .table.table-head-custom thead th {
		    color: black !important;
		    border-bottom-color: white;
		}
		.table.table-head-custom tbody tr td{
			border-bottom-color: white;
			border-top-color: white;
		}
		span.red {
			  background: red;
			   border-radius: 0.8em;
			  -moz-border-radius: 0.8em;
			  -webkit-border-radius: 0.8em;
			  color: #ffffff;
			  display: inline-block;
			  font-weight: lighter;
			  line-height: 1.6em;
			  margin-right: 10px;
			  margin-left: 4px;
			  text-align: center;
			  width: 18px;
    		height: 18px;
		}
	</style>
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
				<div class="card card-custom">
					{{-- NAV --}}
					<ul class="nav nav-tabs" id="myTab" role="tablist">
	                    <li class="nav-item" role="presentation">
	                        <a class="nav-link active" id="compras-tab" data-toggle="tab" href="#compras" role="tab" aria-controls="compras" aria-selected="true">Mis Compras
	                        <span class="red">{{ count($transacciones) }}</span></a>
	                    </li>
	                    <li class="nav-item" role="presentation">
	                        <a class="nav-link" id="solicitudes-tab" data-toggle="tab" href="#solicitudes" role="tab" aria-controls="solicitudes" aria-selected="false">Mis Solicitudes
	                        <span class="red">{{ count($boletas) }}</span></a>
	                    </li>
	                </ul>
	                <div class="tab-content mt-10" id="myTabContent">
	                    <div class="tab-pane fade show active" id="compras" role="tabpanel" aria-labelledby="compras-tab">
	                        {{-- MIS COMPRAS --}}
	                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
								<div class="card-title">
									<h3 class="card-label">Mis Compras</h3>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="mb-7">
									<div class="row align-items-center">
										<div class="col-lg-9 col-xl-8">
											<div class="row align-items-center">
												<div class="col-md-4 my-2 my-md-0">
													<div class="input-icon">
														<input type="text" class="form-control" placeholder="Buscar..." id="kt_datatable_search_query" />
														<span>
															<i class="flaticon2-search-1 text-muted"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
									<thead>
										<tr>
                                            <th>Codigo Transacción</th>
                                            <th>Nombre del Producto</th>
											{{-- <th>Productos</th> --}}
                                            <th>Precio</th>
                                            <th>Estado</th>

                                            <th>Estado proceso</th>


                                            <th>Creado</th>
                                            <th>Accion</th>
										</tr>
									</thead>
									<tbody>
										<?php $cant = 0; ?>
										@foreach($transacciones as $tran)
											<tr>
                                                <td>{{ $tran->codigo }}</td>
                                                <td>
                                                    @foreach ($venta_tr as $item)
                                                       @if ($tran->id == $item->transacciones_id)

                                                          {{$item->venta->cantidad}} {{ $item->venta->producto->nombre }}

                                                       @endif


                                                    @endforeach

                                                </td>
                                                <td>${{ $tran->total }}</td>



                                                <td>
                                                    @if ($tran->estado != null)
                                                        {{$tran->estado}}
                                                    @else
                                                       Sin estado
                                                    @endif
                                                </td>
                                                <td>{{ $tran->estatus->nombre }}</td>


												{{-- @foreach($ventaTransaccion as $vt)
													@if($tran->id == $vt->transacciones_id)
														@foreach($ventas as $v)
															@if($v->id == $vt->ventas_id)
																@foreach($productos as $pro)
																	@if($v->td_productos_id == $pro->id)
																		<td>{{ $pro->nombre }}</td>
																	@endif
																@endforeach --}}
																{{-- <td>{{ $v->cantidad }}</td>
															@endif
														@endforeach
													@endif
												@endforeach--}}
												<td>{{ $tran->created_at->format('j F, Y') }}</td>
												{{-- <td><span class="badge badge-danger text-white" style="background-color: #c00b28c4;">Cancelado</span></td>  --}}
                                                <td>
                                                    @if ($tran->estatus->nombre == "Pendiente de pago")
                                                              <a  class="btn btn-success " href="{{asset('payments/gateway/webpay/transaction')}}/{{$tran->codigo}}"> Pagar</a>
                                                        @endif
                                                </td>

                                            </tr>
										@endforeach
										{{--
										<tr>
											<td>00063629</td>
											<td>$22.672</td>
											<td>2016-11-28</td>
											<td><span class="badge badge-danger text-white" style="background-color: #c00b28c4;">Cancelado</span></td>
										</tr>
										<tr>
											<td>66403315</td>
											<td>$55.141</td>
											<td>2017-04-29</td>
											<td><span class="badge badge-warning text-white">Pendiente</span></td>
										</tr>
										<tr>
										<tr>
											<td>03780357</td>
											<td>$74.919</td>
											<td>2017-09-21</td>
											<td><span class="badge badge-danger text-white">Pagado</span></td>
										</tr>
										 --}}
									</tbody>
								</table>
							</div>
							{{-- END MIS COMPRAS --}}
	                    </div>
	                    <div class="tab-pane fade" id="solicitudes" role="tabpanel" aria-labelledby="solicitudes-tab">
	                        {{-- MIS SOLICITUDES --}}
	                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
								<div class="card-title">
									<h3 class="card-label">Mis Solicitudes</h3>
								</div>
							</div>
							<div class="card-body pt-0">
								<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
									<thead>
	                            	<tr>
                                        <th>ID</th>
                                        <th>Código</th>
	                            		{{-- <th>Nombre Cliente</th> --}}
	                            		{{-- <th>Solicitado Por</th> --}}
	                            		<th>Estado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Fecha Retiro</th>
                                        <th>Retiro</th>
                                        {{-- <th>Creado por</th> --}}
	                            		<th>Acciones</th>
	                            	</tr>
                            	</thead>
                            	<tbody>
                                    @foreach($boletas as $boleta)
                                    <?php
                                        $numero = (string)$boleta->total;
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
                                		<tr>
                                            <th>{{ $boleta->id }}</th>
                                            <th>{{ $boleta->codigo }}</th>
                                			<th>
                                                @if($boleta->estado)
                                                    {{ $boleta->estado->nombre }}
                                                @else
                                                    Sin estado
                                                @endif
                                            </th>

                                			<th>{{ $boleta->created_at }}</th>
                                			<th>{{ $boleta->fecha_hora }}</th>
                                            <th>
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
                                            </th>
                                			<th>
                                				<div class="dropdown dropdown-inline mr-2">
    												<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    												Acciones</button>
    												<!--begin::Dropdown Menu-->
    												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
    													<ul class="nav flex-column nav-hover">
    														<li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp;&nbsp;Escoge una opción:</li>
                                                            <li class="nav-item">
    															<a href="{{asset('tienda/solicitud/seguimiento/'.$boleta->id)}}" class="nav-link">
    																<i class="nav-icon la la-file-excel-o"></i>
    																<span class="nav-text">Seguimiento</span>
    															</a>
    														</li>
    													</ul>
    												</div>
    												<!--end::Dropdown Menu-->
    											</div>
                                			</th>
                                            {{-- @include('workflow::private.modal.logistica.edit') --}}
                                		</tr>
                                    @endforeach
                            	</tbody>
								</table>
							</div>
	                        {{-- END MIS SOLICITUDES --}}
	                    </div>
	                </div>
					{{-- ENDNAV --}}
				</div>
			</div>
		</div>
	</div>

@endsection
