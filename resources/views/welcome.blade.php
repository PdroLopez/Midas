@extends('layouts.master')

@section('content')
    <style type="text/css">
        .card-title{
            height: 36px;
        }
        .splide__arrow{
            background-color: #8fca00;
        }
        .splide__arrow svg path{
            fill: white;
        }
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
    @if(count($imagen_portal) == 0)
    <div id="img" class="carousel slide" data-ride="carousel" style="margin-top: -40px;margin-bottom: -53px;height: 38%;">

        <div class="carousel-inner" style="height: 100%;">
            @foreach ($img as $item)
                <div class="carousel-item {{ $item->active }} " style="height: 90%;">
                    <img class="img second-slide" src="{{asset('storage/'.$item->ruta)}}" alt="{{ $item->atributos }}">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{ $item->texto_principal }}</h1>
                            <p>{{ $item->texto_secundario }}</p>
                            <p><a class="btn btn-lg btn-primary" href="{{ $item->btn_url  }} " role="button">{{ $item->btn_texto }} </a></p>
                        </div>
                    </div>
                </div>
            @endforeach
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
    @endif
    @if(count($img) != 0)
        <div id="img" class="carousel slide" data-ride="carousel" style="margin-top: -40px;margin-bottom: -53px;height: 38%;">
            <div class="carousel-inner" style="height: 100%;">
                @foreach ($img as $item)
                    <div class="carousel-item {{ $item->active }} " style="height: 90%;">
                        <img class="img second-slide" src="{{asset('storage/'.$item->ruta)}}" alt="{{ $item->atributos }}" style="height: 500px; width: 100%">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>{{ $item->texto_principal }}</h1>
                                <p>{{ $item->texto_secundario }}</p>
                                <p><a class="btn btn-lg btn-primary" href="{{ $item->btn_url  }} " role="button">{{ $item->btn_texto }} </a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    @endif
{{--     <div class="container mt-20 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-1">
                <div class="row">
                    <div class="col-12 text-center my-10">
                        <h2>Servicios</h2>
                    </div>
                    <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/reciclar.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Destrucción Certificada de Productos</h4>
                        </a>
                    </div>
                    <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/papelera.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Reciclaje de Residuos</h4>
                        </a>
                    </div>
                     <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/reciclar.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Almacenamiento y transporte de residuos</h4>
                        </a>
                    </div>
                    <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/reciclar.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Asesoría en sustentabilidad</h4>
                        </a>
                    </div>
                    <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/papelera.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Disposición Puntos de Reciclaje en colegios y empresas</h4>
                        </a>
                    </div>
                     <div class="col-md-4 col-6 text-center mb-10">
                        <a href="">
                            <img class="rounded-circle mb-4" src="{{ asset('img/reciclar.svg') }}" alt="Generic placeholder image" width="60" height="60">
                            <h4 class="text-dark">Operación sustentable</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container mt-20 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-1">
                <div class="row">
                    <div class="col-12 text-center my-10">
                        <h2>Servicios</h2>
                    </div>
                    @foreach($servicios_home as $serviho)
                        <div class="col-md-4 col-6 text-center mb-10">
                            <a href="">
                                <i class="{{$serviho->icono}} fa-5x" style="color:#8fca00;"></i><br><br>
                                <h4 class="text-dark">{{$serviho->nombre}}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="content pt-0">
        <h2 class="text-center">Servicios</h2>
    </div>
    <div class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/reciclar.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Destrucción Certificada de Productos</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/reciclar.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Reciclaje de Residuos</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/papelera.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Almacenamiento y transporte de residuos</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/reciclar.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Asesoría en sustentabilidad</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/papelera.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Disposición Puntos de Reciclaje en colegios y empresas</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="col-12">
                        <div class="card w-100" style="width: 18rem;">
                          <img class="card-img-top p-10" src="{{ asset('img/reciclar.svg') }}" height="200">
                          <div class="card-body text-center">
                            <h5 class="card-title">Operación sustentable</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                          </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="splide__progress mt-10">
            <div class="splide__progress__bar">
            </div>
        </div>
    </div> --}}
    {{-- <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            new Splide( '.splide', {
                type    : 'loop',
                perPage : 3,
                //autoplay: true,
                padding: {
                    right: '5rem',
                    left : '5rem',
                },
                breakpoints: {
                    '890': {
                        perPage: 2,
                        gap    : '1rem',
                    },
                    '680': {
                        perPage: 1,
                        gap    : '1rem',
                    },
                }
            } ).mount();
        } );
    </script> --}}
@endsection
