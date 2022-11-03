@extends('tienda::layouts.public.master')

@section('tienda::content')
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
   @if(count($img) != 0)
        <div id="img" class="carousel slide" data-ride="carousel" style="margin-top: -40px;margin-bottom: -53px;height: 38%;">
            <div class="carousel-inner" style="height: 100%;">
                @foreach ($img as $item)
                    <div class="carousel-item {{ $item->active }} ">
                        <img class="img second-slide" style="height: 450px; width: 100%" src="{{asset('storage/'.$item->ruta)}}" alt="{{ $item->atributos }}">
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


	<div class="container mt-md-30 mt-10 mb-0">
		<div>{{-- <div class="card card-custom card-stretch gutter-b" style="height: auto;"> --}}
			<div class="card-body">
				{{--  --}}

                        <h3 class=" text-center">Categorías</h3>
                        <hr>
                    <div class="row">
                        @foreach ($categorias as $item)
                        <div class="col">
                            <a class="btn btn btn-light-primary"href="{{asset('tienda/ver-productos')}}/{{$item->id}}/{{'categorias'}}"> {{$item->nombre}}</a>

                        </div>

                        @endforeach

                    </div>
					{{-- <div class="checkbox-list">
						<div class="row m-0">
							<div class="col-6 p-0">
								<a href="{{ asset('/tienda/productos') }}">Productos <span>{{ count($productos) }}</span></a>
							</div>
							{{--
                            <div class="col-6 p-0">
								<a href="{{ asset('/tienda/servicios') }}">Servicios <span>6</span></a>
							</div>
                             --}}
            </div>
        </div>
    </div>
    <div class="container mt-md-30 mt-10 mb-0">
				<div class="row">
					<div class="col-12">
						{{--
						<div class="card card-custom card-stretch card-stretch-half gutter-b overflow-hidden">
							<div class="card-body p-0 d-flex rounded bg-light-success">
								<div class="py-18 px-12">
									<h3 class="font-size-h1">
										<a href="{{ asset('/tienda/servicios') }}" class="text-dark font-weight-bolder">Servicios</a>
									</h3>
									<div class="font-size-h4 text-success">Contrata nuestros servicios</div>
								</div>
								<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-size: contain;margin: 25px;margin-left: 250px;background-image: url('{{ asset('img/midas.png')}}')"></div>
							</div>
						</div>
						 --}}
                         <div class="card card-custom gutter-b overflow-hidden">
                            <div class="card-body p-0 d-flex rounded bg-light-danger">
                                <div class="py-18 px-12">
                                    <h3 class="font-size-h1">
                                        <a href="{{ asset('/tienda/productos') }}" class="text-dark font-weight-bolder">{{$banner->texto1}}</a>
                                    </h3>
                                    <div class="font-size-h4 text-danger">{{$banner->texto2}}</div>
                                <p><a class="btn btn-lg btn-primary" href="{{$banner->url}}" role="button">{{$banner->boton}}</a></p>

                                </div>
                                <img class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover"  src="{{asset('storage/'.$banner->ruta)}}">

                            </div>
                        </div>
					</div>
				</div>
				<div class="row">
                    <h3 class="font-size-h1">
                        <a href="" class="text-dark font-weight-bolder">Productos</a>
                    </h3>
                 	@foreach ($productos as $producto)
					<a href="{{ asset('/tienda/producto/'.$producto->id) }}">
						<div class="col-12 col-sm-6 col-md-4">
							<div class="card card-custom gutter-b card-stretch">
								<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
									<div class="text-center rounded mb-7">
										<img src="{{asset('storage/'.$producto->imagen)}}" width="200" style="border-radius: 10px;">
									</div>
									<div>
										<h4 class="font-size-h5">
											<a href="{{ asset('/tienda/producto/'.$producto->id) }}" class="text-dark-75 font-weight-bolder">{{ $producto->nombre }}</a>
										</h4>
										<div class="font-size-h6 text-muted font-weight-bolder">${{ number_format($producto->precio) }}</div>
									</div>
								</div>
							</div>
						</div>
					</a>
					@endforeach


				</div>
			{{-- </div>
		</div> --}}
	</div>
@endsection
