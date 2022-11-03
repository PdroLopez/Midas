@extends('layouts.master')

@section('content')
<style type="text/css">
    .carousel-indicators{
        margin-bottom: 60px;
    }
    @media only screen and (max-width: 991px) {
        .carousel{
            height: 100% !important;
        }
        .carousel-caption{
            bottom: 25px;
        }
        .card-img-top{
            height: 150px;
        }
        .carousel-item{
            height: 83% !important;
        }
        .img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
        }
        .carousel-control-prev{
            height: 83% !important;
        }
        .carousel-control-next{
            height: 83% !important;
        }
    }
    @media only screen and (max-width: 768px) {
        .carousel {
            height: 300px !important;
        }
    }
</style>
    <div id="img" class="carousel slide" data-ride="carousel" style="margin-top: -40px;margin-bottom: -53px;height: 38%;">
        <ol class="carousel-indicators">
            <li data-target="#img" data-slide-to="0" class="active"></li>
            <li data-target="#img" data-slide-to="1" class=""></li>
            <li data-target="#img" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner" style="height: 100%;">
            <div class="carousel-item active" style="height: 90%;">
                <img class="img first-slide" src="https://wowslider.com/sliders/demo-77/data1/images/road220058.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Donec sed odio dui</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">View details</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 90%;">
                <img class="img second-slide" src="https://wowslider.com/sliders/demo-77/data1/images/road220058.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Donec sed odio dui</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">View details</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 90%;">
                <img class="img third-slide" src="https://wowslider.com/sliders/demo-77/data1/images/road220058.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>Donec sed odio dui</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">View details</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#img" role="button" data-slide="prev" style="height: 100%;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#img" role="button" data-slide="next" style="height: 100%;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="position-relative bg-light p-5" width="1200px" height="auto" style="background-image: url('{{asset('img/prueba.jpeg')}}');    background-repeat: no-repeat;  background-position: center center; background-attachment: local;  background-size: cover;">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <h1 class="display-4 font-weight-normal">Comunidades</h1>
                </div>
                <div class="col-lg-6 col-12">
                    {{-- <a href="#" class="btn btn-sm btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">
                        <span class="svg-icon svg-icon-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                    <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                    <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Mas Info
                    </a> --}}
                    {{-- <a href="{{ asset('/crear-comunidad/paso-1') }}" class="btn btn-sm btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">
                        <span class="svg-icon svg-icon-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Crea tu Comunidad
                    </a> --}}
                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>

    <div class="container mt-md-20 mt-10 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-1">
                <div class="tab-content mt-5" id="myTabLIist18">
                    @foreach ($comunidades as $comunidad)
                        <div class="d-flex align-items-center pb-9">
                            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                @if ($comunidad->foto != null)
                                <h1>
                                    <img class="symbol-label" src="{{asset('storage/'.$comunidad->foto)}}" width="150px;" height="auto">

                                </h1>

                                @else
                                <h1>Sin Foto</h1>

                                @endif
                                {{--                          <div class="symbol-label"  src="{{ asset('public/comunidades').'/'.$comunidad->foto }}" height="150"></div>
                                --}}
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="#" class="text-dark-75 font-weight-bolder font-size-lg text-hover-primary mb-1">{{ $comunidad->nombre }} </a>
                                <span class="text-dark-50 font-weight-normal font-size-sm">{{ $comunidad->descripcion }}</span>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
