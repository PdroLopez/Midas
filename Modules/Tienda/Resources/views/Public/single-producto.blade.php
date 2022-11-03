@extends('tienda::layouts.public.master')

@section('tienda::content')
    <style type="text/css">
        .carousel-control-next-icon {
            background-image: url('{{ asset('img/right-arrow.svg') }}');
        }
        .carousel-control-prev-icon {
            background-image: url('{{ asset('img/right-arrow.svg') }}');
            transform: rotate(180deg);
        }
        @media only screen and (min-width: 1400px) {
            .carousel {
                width: 550px;
            }
            .carousel-inner{
                height: 550px;
            }
        }
        @media only screen and (max-width: 1200px) {
            .carousel {
                width: 100%;
            }
            .carousel-inner{
                height: 550px;
            }
        }
        @media only screen and (max-width: 991px) {
            .carousel {
                width: 550px;
                margin-right: 20px;
            }
            .carousel-inner{
                height: 550px;
            }
        }
        @media only screen and (max-width: 926px) {
            .carousel {
                width: 485px;
                margin-right: 20px;
            }
            .carousel-inner {
                height: 480px;
            }
        }
        @media only screen and (max-width: 861px) {
            .carousel {
                width: 420px;
                margin-right: 20px;
            }
        }
        @media only screen and (max-width: 768px) {
            .carousel {
                width: 100%;
            }
        }
        @media only screen and (max-width: 580px) {
            .carousel {
                width: 100%;
            }
            .carousel-inner {
                height: 100%;
            }
            .carousel-item{
                padding: 0px;
            }
        }

        .carousel-item{
            padding: 50px;
        }
    </style>
	<div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success" role="alert" id="success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <script type="text/javascript">
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 5000);
        </script>

        <div class="d-flex flex-row">
        @if(Session::has('mensaje'))
            <div class="col-10 mt-5 mb-0 ml-auto mr-auto alert alert-custom alert-{{ Session::get('mensaje')['type'] }} fade show" role="alert" style="height: 60px;">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">{{ Session::get('mensaje')['content'] }}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">{{-- <i class="ki ki-close"></i> --}}</span>
                    </button>
                </div>
            </div>
        @endif

            <div class="flex-column offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="form-group mb-11">
                            <label class="font-size-h3 font-weight-bolder text-dark mb-7">Más Productos</label>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Productos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $pro)
                                            <tr>
                                                <td class="d-flex align-items-center font-weight-bolder">
                                                    <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                                        <div class="symbol-label" style="background-image: url('{{ asset('storage/'.$pro->imagen) }}')"></div>
                                                    </div>
                                                    <a href="{{ asset('/tienda/producto/'.$pro->id) }}" class="text-dark text-hover-primary">{{ $pro->nombre }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-row-fluid ml-lg-8">
                <div class="card card-custom gutter-b">
                    <div class="card-body d-flex rounded bg-secondary p-12 flex-column flex-md-row flex-lg-column flex-xxl-row">
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover {{-- h-300px h-md-auto h-lg-300px h-xxl-auto mw-100 w-550px --}} mb-5" >
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <center>
                                            <img class="img-fluid" align="center" src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen 1">
                                        </center>
                                    </div>
                                    <div class="carousel-item">
                                        <center>
                                           <img class="img-fluid" align="center" src="{{ asset('storage/'.$producto->imagen2) }}" alt="Imagen 2">
                                        </center>
                                    </div>
                                    <div class="carousel-item">
                                        <center>
                                            <img class="img-fluid" align="center" src="{{ asset('storage/'.$producto->imagen3) }}" alt="Imagen 3">
                                        </center>
                                    </div>
                                    <div class="carousel-item">
                                        <center>
                                            <img class="img-fluid" align="center" src="{{ asset('storage/'.$producto->imagen4) }}" alt="Imagen 4">
                                        </center>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="card card-custom w-auto w-md-300px w-lg-auto w-xxl-300px">
                            <div class="card-body px-12 py-10">
                                <h3 class="font-weight-bolder font-size-h2 mb-1">
                                    <a href="#" class="text-dark-75">{{ $producto->nombre }}</a>
                                </h3>


                                <hr>
                                <div class="d-flex mb-3">

                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    {{--<br><p> 4.1 <a href="{{ asset('tienda/producto/{{$pro->id}}/valoracion')}}"> ( 2453 ) </a> </p>
--}}
                                     <br><p> {{$prom_final}} <a href="{{ asset('tienda/producto/')}}/{{$producto->id}}/valoracion"> ({{$comentarios}}) </a> </p>

                                    <hr style="border:3px solid #f1f1f1">
                                </div>
                                <hr>


                                <div class="text-primary font-size-h4 mb-9">$ {{ number_format($producto->precio) }}</div>

                                <div class="d-flex mb-3">
                                    <span class="text-dark-50 flex-root font-weight-bold">Categoría</span>
                                    <span class="text-dark flex-root font-weight-bold">{{ $producto->categoria['nombre'] }}</span>
                                </div>
                                <div class="d-flex mb-3">
                                    <span class="text-dark-50 flex-root font-weight-bold">Marca</span>
                                    <span class="text-dark flex-root font-weight-bold">{{ $producto->marca['nombre'] }}</span>
                                </div>

                                @if($producto->descuentos != null)
                                    <div class="d-flex mb-3">
                                        <span class="text-dark-50 flex-root font-weight-bold">Descuento</span>
                                        <span class="text-dark flex-root font-weight-bold">{{ $producto->descuentos['nombre'] }}</span>
                                    </div>
                                @else

                                @endif







                                <div class="font-size-sm mb-8">{{ $producto->descripcion }}</div>








                                <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle mb-5" id="accordionExample7">
                                    <div class="card">
                                        <div class="card-header" id="headingTwo7">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo7" aria-expanded="true" role="button">
                                                <span class="svg-icon svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                                <div class="card-label text-dark pl-4">Características</div>
                                            </div>
                                        </div>
                                        <div id="collapseTwo7" class="collapse" aria-labelledby="headingTwo7" data-parent="#accordionExample7">
                                            <div class="card-body text-dark-50 font-size-lg pl-12">{!! $producto->caracteristicas !!}</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="d-flex">
                                    <span class="text-dark-50 flex-root font-weight-bold">Stock</span>
                                    <span class="text-dark flex-root font-weight-bold">{{ $producto->stock }}</span>
                                </div> --}}
                            </div>
                            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                <div class="col-md-10">
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-light-primary font-weight-bold" href="{{ url()->previous() }}">Volver</a>
                                        <form action="{{ asset('tienda/carro') }}" method="post" files="true" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-primary font-weight-bold">Agregar al carro</button>
                                            {!! Form::hidden('id', $producto->id) !!}
                                            {!! Form::hidden('nombre', $producto->nombre) !!}
                                            {!! Form::hidden('imagen', $producto->imagen) !!}
                                            {!! Form::hidden('descripcion', $producto->descripcion) !!}
                                            {!! Form::hidden('categoria', $producto->categoria) !!}
                                            {!! Form::hidden('marca', $producto->marca) !!}
                                            {!! Form::hidden('precio', $producto->precio) !!}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection
