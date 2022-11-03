@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Ventas</h5>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                <li class="breadcrumb-item">
	                    <a href="" class="text-muted">Administrador </a>
	                </li>
	            </ul>
	            <br><br>&nbsp;
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                <li class="breadcrumb-item">
	                    <a href="" class="text-muted"> Tienda</a>
	                </li>
	            </ul>

            </div>

        </div>

    </div>
</div>
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Ventas</h3>
                    <div class="ml-10">
                        <a href="{{ asset('tienda/export-ventas') }}" class="btn btn-info">Exportar Ventas Cortas</a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#create-venta"><i class="fas fa-plus"></i> Crear Venta</a>
                        @include('tienda::Admin.ventas.create')

                        {{-- <a href="{{ asset('tienda/export-ventas/webpay') }}" class="btn btn-primary">Exportar Webpay<i class="fas fa-plus"></i></a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                            <th>ID</th>
                            <th>Total</th>
                            <th>Comprado Por</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Estatus</th>
                            <th>Forma Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $tr_array = array();
                            $existe = 0;
                        ?> 
                        @foreach($ventas as $venta)
                            <tr>
                            @if ($venta->tran_venta->count()!=0)
                                <?php 
                                    $existe = 0;
                                ?> 
                                @foreach($venta->tran_venta->first()->transaccion->tran_venta->whereIn('transacciones_id',$tr_array) as $tr)
                                    @if($venta->id == $tr->ventas_id)
                                        <?php 
                                            $existe = 1;
                                        ?> 
                                    @endif
                                @endforeach
                                <?php 
                                    array_push($tr_array,$venta->tran_venta->first()->transacciones_id);
                                ?>
                                @if($existe != 1)
                                    <td>#{{ $venta->id }}</td>
                                    <td>${{number_format($venta->tran_venta->first()->transaccion->total, 0, ',', '.')}}</td>
                                    <td>
                                        @if($venta->tran_venta->first()->transaccion->user != null)
                                        {{ $venta->tran_venta->first()->transaccion->user->name }}
                                        @else
                                            @if ($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                                {{ $venta->tran_venta->first()->transaccion->ventas_fuera->nombre }}
                                            @elseif($venta->tran_venta->first()->transaccion->boletas_id != null)
                                                {{$venta->tran_venta->first()->transaccion->boleta->nombre}}
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $venta->tran_venta->first()->transaccion->created_at->format('Y/m/d H:i')}}</td>
                                    <td>
                                        {{ $venta->tran_venta->first()->transaccion->estado}}
                                    </td>
                                    <td>
                                        @if($venta->tran_venta->first()->transaccion->estatus != null)
                                            {{ $venta->tran_venta->first()->transaccion->estatus->nombre }}
                                        @else
                                            <p>Sin Estado</p>
                                        @endif
                                    </td>
                                    <td>WebPay Tranferencia Electronica</td>
                                    <td>
                                        <a class="btn btn-info" data-toggle="modal" data-target="#detalle{{$venta->id}}">Ver Detalles</a>
                                        <a class="btn btn-info" data-toggle="modal" data-target="#estatus{{$venta->id}}">Cambiar Estatus</a>
                                        <a class="btn btn-info" href="{{ asset('tienda/admin/descargar-trans/pdf/'.$venta->tran_venta->first()->transacciones_id) }}">Comprobante</a>
                                        @include('tienda::Admin.ventas.destroy')
                                    </td>
                                    @include('tienda::Admin.ventas.cambiar-estado')
                                    @include('tienda::Admin.ventas.cambiar-estatus')
                                    @include('tienda::Admin.ventas.detalle_trans')
                                @endif
                            @else
                                @if($venta->despacho_valor != null)
                                    <?php 
                                        $despacho = $venta->despacho_valor;
                                    ?>
                                @else
                                    <?php 
                                        $despacho = 0;
                                    ?>
                                @endif
                                <td>#{{ $venta->id }}</td>
                                <td>${{number_format(($venta->producto->precio*$venta->cantidad)+$despacho, 0, ',', '.')}}</td>
                                <td>
                                    @if($venta->ventas_fuera != null)
                                    {{ $venta->ventas_fuera->nombre }}
                                    {{-- @elseif() --}}
                                    @else
                                        @if($venta->users_id != null)
                                            {{ $venta->user->name }}
                                        @else
                                            Sin Registro
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $venta->created_at->format('Y/m/d H:i')}}</td>
                                <td>
                                    {{$venta->estado}}
                                </td>
                                <td>
                                    @if($venta->bk_estatus_id != null)
                                        {{ $venta->estatus->nombre }}
                                    @else
                                        <p>Sin Estado</p>
                                    @endif
                                </td>
                                <td>
                                    @if($venta->tipo_pago != null)
                                        @if ($venta->tipo_pago == 'efectivo')
                                            Efectivo
                                        @elseif($venta->tipo_pago == 'transbank')
                                            Pos Móvil Transbank
                                        @elseif($venta->tipo_pago == 'transferencia')
                                            Tranferencia APP    
                                        @endif
                                    @else
                                        <p>Sin Registro</p>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" data-toggle="modal" data-target="#detalle{{$venta->id}}">Ver Detalles</a>
                                    <a class="btn btn-info" data-toggle="modal" data-target="#estado{{$venta->id}}">Cambiar Estado</a>
                                    <a class="btn btn-info" data-toggle="modal" data-target="#estatus{{$venta->id}}">Cambiar Estatus</a>
                                    <a class="btn btn-info" href="{{ asset('tienda/admin/descargar-ven/pdf/'.$venta->id) }}">Comprobante</a>
                                    @include('tienda::Admin.ventas.destroy')

                                </td>
                                @include('tienda::Admin.ventas.detalle')
                                @include('tienda::Admin.ventas.cambiar-estado')
                                @include('tienda::Admin.ventas.cambiar-estatus')
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
