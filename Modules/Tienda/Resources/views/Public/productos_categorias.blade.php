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
    </div>

{{-- <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="flex-column offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="form-group mb-11">
                            <label class="font-size-h3 font-weight-bolder text-dark mb-7"></label>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Productos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($producto as $item)
                                            <tr>
                                                <td>
                                                     <img src="{{asset('storage/'.$item->imagen)}}" width="50%" height="auto">
                                                    {{$item->nombre}}
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
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card-title" style="text-align: center; width:1200px; height:auto;">
                Productos
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto as $item)
                            <tr>
                                <td>
                                    {{$item->nombre}}
                                </td>
                                <td>
                                     <img src="{{asset('storage/'.$item->imagen)}}" width="500px;" height="auto">
                                </td>
                                <td>
                                    <a class="btn btn-success font-weight-bold text-uppercase px-9 py-4" href="{{asset('tienda/producto')}}/{{$item->id}}">Ver Detalles</a>
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
@endsection
