@extends('layouts.master')

@section('content')
    <style type="text/css">
      .card-img, .card-img-top, .card-img-bottom {
        -ms-flex-negative: 0;
        flex-shrink: 0;
        width: 100%;
        height: auto;
      }
      @media only screen and (max-width: 576px) {
        .aux{
          width: 100px;
        }
        .card-img-top{
          height: auto;
        }
      }
    </style>
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light" style="margin-top: -40px !important;background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url('{{ asset('storage/'.$imagen->portada) }}');background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-8 p-lg-8 mx-auto my-5">
            <h1 class="display-4 font-weight-normal mt-5 mb-5 text-white">{{ $imagen->noticia->titulo }}</h1>
            <p class="lead font-weight-normal text-white">{{ $imagen->noticia->subtitulo }}</p>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
    <div class="container px-lg-5 px-md-20 px-15 my-md-15 my-10">
        <div class="">
          <div class="text-justify d-md-block d-none">
            <img class="img-fluid ml-3" src="{{ asset('storage/'.$imagen->img_descripcion ) }}" width="50%" style="float:right;">
            {!! $imagen->noticia->descripcion !!}
          </div>
          <div class="text-justify d-md-none d-block">
            {!! $imagen->noticia->descripcion !!}
          </div>
          <div class="d-md-none d-flex">
            <img class="img-fluid mt-5" src="{{ asset('storage/'.$imagen->detalle ) }}" width="100%">
          </div>

          <p style="text-align: justify;"> <b>Fuente:</b> <br>   {!! $imagen->noticia->url !!}</p>
        </div>
    </div>
@endsection
