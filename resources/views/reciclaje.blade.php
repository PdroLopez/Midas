@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light" style="margin-top: -40px !important;">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 text-left font-weight-normal">Verficar si el producto fue reciclado</h1>
            <p class="lead font-weight-normal">Ingrese el código otorgado</p>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        
    </div>
    {{-- SECCION --}}
    <div class="d-md-flex flex-md-equal w-100 row px-20 py-10">


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

        <div class="bg-light overflow-hidden col-12 pr-2 p-15">
            <form action="{{ asset('verificar-codigo') }}" method="post">
                @csrf
                <div class="my-3 p-3">
                    <h4 class="display-5">Ingrese el código</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="codigo">
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
    {{--  
{!!QrCode::size(300)->generate("www.nigmacode.com") !!}
--}}
@endsection
<script type="text/javascript">
    setTimeout(function() {
        $('.alert-custom').fadeOut('fast');
    }, 5000);
</script>