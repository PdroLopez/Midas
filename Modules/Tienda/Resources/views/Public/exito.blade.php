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
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-12 col-12 text-center p-3">
                    <h1 class="display-4 font-weight-normal">Pago Exitoso</h1>
                </div>
                <div class="col-md-12 col-12 text-center">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="width: 50px !important;height: 50px !important;">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M9.26193932,16.6476484 C8.90425297,17.0684559 8.27315905,17.1196257 7.85235158,16.7619393 C7.43154411,16.404253 7.38037434,15.773159 7.73806068,15.3523516 L16.2380607,5.35235158 C16.6013618,4.92493855 17.2451015,4.87991302 17.6643638,5.25259068 L22.1643638,9.25259068 C22.5771466,9.6195087 22.6143273,10.2515811 22.2474093,10.6643638 C21.8804913,11.0771466 21.2484189,11.1143273 20.8356362,10.7474093 L17.0997854,7.42665306 L9.26193932,16.6476484 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(14.999995, 11.000002) rotate(-180.000000) translate(-14.999995, -11.000002) "/>
                                <path d="M4.26193932,17.6476484 C3.90425297,18.0684559 3.27315905,18.1196257 2.85235158,17.7619393 C2.43154411,17.404253 2.38037434,16.773159 2.73806068,16.3523516 L11.2380607,6.35235158 C11.6013618,5.92493855 12.2451015,5.87991302 12.6643638,6.25259068 L17.1643638,10.2525907 C17.5771466,10.6195087 17.6143273,11.2515811 17.2474093,11.6643638 C16.8804913,12.0771466 16.2484189,12.1143273 15.8356362,11.7474093 L12.0997854,8.42665306 L4.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.999995, 12.000002) rotate(-180.000000) translate(-9.999995, -12.000002) "/>
                            </g>
                        </svg>
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
                                    {{ $transaccion->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder font-size-h4 text-left">Dirección</td>
                                <td colspan="1"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">
                                    {{ $transaccion->direccion->nombre }}, 
                                    {{ $transaccion->direccion->region->nombre }}, 
                                    {{ $transaccion->direccion->comuna->nombre }}
                                </td>
                            </tr>
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
                            {{-- @endif --}}
                        </tbody>
                    </table>
                </div>

                <h2 class="mb-5 mt-10">Total : <strong>{{ $transaccion->total }}</strong></h2>

            </div>
            <div class="row pb-10">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light-primary font-weight-bold ml-10" onclick="window.print();">Descargar</button>
                        <form action="{{ asset('tienda/finalizar') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-10">Finalizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection