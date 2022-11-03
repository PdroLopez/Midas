@extends('layouts.master')

@section('content')
    <style type="text/css">
        .svg-icon.svg-icon-primary svg g [fill] {
            -webkit-transition: fill 0.3s ease;
            transition: fill 0.3s ease;
            fill: red !important;
        }
    </style>
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-12 col-12 text-center p-3">
                    <h1 class="display-4 font-weight-normal">Solicitud Cancelada</h1>
                </div>
                <div class="col-md-12 col-12 text-center">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="width: 50px !important;height: 50px !important;">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" style="fill: red !important;">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                    <rect x="0" y="7" width="16" height="2" rx="1"/>
                                    <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
                                </g>
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
            <div class="row py-10">
                <div class="col-12 text-center">
                    <a href="{{ asset('/') }}" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Finalizar</a>
                </div>
            </div>
        </div>
    </div>
@endsection