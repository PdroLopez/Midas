@extends('tienda::layouts.public.master')

@section('tienda::content')
    <style type="text/css">
        .header.header-fixed{
            display: none;
        }
        .content.d-flex.flex-column.flex-column-fluid{
            margin-top: -50px;
        }
        .footer.bg-white.py-4.d-flex.flex-lg-column{
            display: none !important;
        }
    </style>
    <div class="position-relative overflow-hidden bg-light">
        {{$transaccion->created_at->format('d/m/Y')}} Tienda | MidasChile | <img width="30px" src="{{ asset('img/logoinstagram.png') }}"> @midaschile
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-12 col-12 text-center p-3">
                    <h1 class="display-4 font-weight-normal">UPS ALGO SALIO MAL </h1>
                    <h1 class="display-4 font-weight-normal">{{ $transaccion->estado }} </h1>

                </div>
                <div class="col-md-12 col-12 text-center">
                    <span class="svg-icon svg-icon-danger svg-icon-2x">
                        <i class="fas fa-exclamation-triangle fa-10x" style="color: red;"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>

    <div class="container mt-md-10 mt-10 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-8 p-md-10 p-5">
                <h2 class="mb-5">Resumen</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center"></th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">ID Pago</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">{{ $transaccion->codigo }}</td>
                                {{--  --}}
                            </tr>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Nombre</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    {{ $transaccion->ventas_fuera->nombre }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Direcci??n</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    {{ $transaccion->ventas_fuera->direccion }}  @if($transaccion->ventas_fuera->bk_comunas_id != null),{{$transaccion->ventas_fuera->comuna->nombre}} @endif @if($transaccion->ventas_fuera->bk_regiones_id != null), {{$transaccion->ventas_fuera->region->nombre}} @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Tipo Tarjeta</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    {{ $tipo_tarjeta}}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Tarjeta N??</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    N??XXXXXXXX{{ $Ntarjeta}}
                                </td>
                            </tr>
                            @if($tipo_tarjeta != 'RedCompra')
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Cuotas</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    {{$cuotas}}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="font-weight-bolder font-size-h4 text-left">Nos pondremos en contacto con ud a la brevedad.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="mb-5 mt-10">Productos</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center"></th>
                                <th class="text-right">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if(Session::has('carro')) --}}
                                @foreach($ventas as  $venta)
                                    <tr>
                                        <td class="font-weight-bolder font-size-h4 text-left">{{ $venta->venta->producto->nombre}}</td>
                                        <td colspan="1"></td>
                                        <td class="font-weight-bolder font-size-h4 text-right">{{ $venta->venta->cantidad }}</td>
                                    </tr>
                                @endforeach
                                @if ($transaccion->tran_venta->first()->venta->bk_despacho_id != null)
                                        <tr>
                                            <td class="font-weight-bolder font-size-h4 text-left">Despacho</td>
                                            <td colspan="1"></td>
                                                @if($transaccion->tran_venta->first()->venta->despacho->bk_cobertura_id == 1)
                                                <td class="font-weight-bolder font-size-h4 text-right">${{ $ventas->first()->venta->despacho_valor}}</td>
                                                @else
                                                <td class="font-weight-bolder font-size-h4 text-right">Envio por pagar via Starken</td>
                                                @endif
                                        </tr>
                                    @endif
                            {{-- @endif --}}
                        </tbody>
                    </table>
                </div>

                <h2 class="mb-5 mt-10">Total : <strong>{{ $transaccion->total }}</strong></h2>

            </div>
            <div class="row pb-10">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light-primary font-weight-bold ml-10" style="color: #ffffff;background-color: red;border-color: transparent;" onclick="window.print();">Descargar</button>
                        <a href="https://www.instagram.com/midaschile/" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-10" style="color: #FFFFFF;background-color: red;border-color: red;">Finalizar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection