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
 <div class="col-12">

    <div class="card card-custom gutter-b overflow-hidden">
                <div class="card-body p-0 d-flex rounded bg-light-danger">
                    <div class="py-18 px-12">
                        <h3 class="font-size-h1">
                            <a href="{{ asset('/tienda/noticias') }}" class="text-dark font-weight-bolder">{{$banner->texto1}}</a>
                        </h3>
                        <div class="font-size-h4 text-danger">{{$banner->texto2}}</div>
                    <p><a class="btn btn-lg btn-primary" href="{{$banner->url}}" role="button">{{$banner->boton}}</a></p>

                    </div>
                   <img class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover"  src="{{asset('storage/'.$banner->ruta)}}">
                </div>
            </div>
</div>
    {{-- <div class="position-relative overflow-hidden p-12 p-md-12 text-center bg-light" >

        <div class="col-md-12 p-lg-12 mx-auto my-12">
            <div class="card card-custom gutter-b overflow-hidden">
                <div class="card-body p-0 d-flex rounded bg-light-danger">
                    <div class="py-18 px-12">
                        <h3 class="font-size-h1">
                            <a href="{{ asset('/tienda/noticias') }}" class="text-dark font-weight-bolder">{{$banner->texto1}}</a>
                        </h3>
                        <div class="font-size-h4 text-danger">{{$banner->texto2}}</div>
                    <p><a class="btn btn-lg btn-primary" href="{{$banner->url}}" role="button">{{$banner->boton}}</a></p>

                    </div>
                   <img class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover"  src="{{asset('storage/'.$banner->ruta)}}">

                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div> --}}
    <div class="container mt-5">
        {{--
        <nav class="navbar navbar-expand navbar-light bg-light mb-10">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categorías
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Categoría 1</a>
                  <a class="dropdown-item" href="#">Categoría 2</a>
                  <a class="dropdown-item" href="#">Categoría 3</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-2 aux" type="search" placeholder="buscar" aria-label="Search">
              <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
            </form>
          </div>
        </nav>
         --}}
        <div class="row mb-8">
            @foreach($imagen as $img)
                @if($img->noticia->categoria != null)
                    @foreach (json_decode($img->noticia->categoria) as $cate)
                        @if ($cate == 2)
                            <div class="col-md-4 col-sm-6 col-12 mb-8">
                                <div class="card w-100" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ asset('storage/'.$img->miniatura) }}" height="300">

                                    <div class="card-body">
                                    <h5 class="card-title">{{ $img->noticia->titulo }}</h5>
                                    <p class="card-text">{{ $img->noticia->subtitulo }}</p>
                                    <a href="{{ asset('/noticias/'.$img->noticia->slug) }}" class="btn btn-primary">leer</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        {{ $imagen->links() }}
    </div>
@endsection
