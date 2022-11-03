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
                    <h1 class="display-4 font-weight-normal">UPS ALGO SALIO MAL</h1>
                    <h1 class="display-4 font-weight-normal">INTENTELO MAS TARDE</h1>

                </div>
                <div class="col-md-12 col-12 text-center">
                    <span class="svg-icon svg-icon-danger svg-icon-2x">
                        <i class="fas fa-exclamation-triangle fa-10x"></i>
                    </span>
                </div>
                <div class="col-md-12 col-12 text-center">
                    <div class="d-flex justify-content-between">
                    <a href="{{asset('/')}}" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-10">Volver</a>
                </div>
                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
@endsection