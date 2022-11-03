@extends('login::layouts.master')
@section('content')
<div class="mb-20">
    <h3>Midas Chile</h3>
    <div class="text-muted font-weight-bold">Ingrese sus datos</div>
</div>
<form method="POST" action="{{ asset('login/register/telefono') }}">
    @csrf
    <div class="form-group mb-5">
        <input id="telefono" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="telefono" placeholder="9 12345678" required autocomplete="+56912345678">
    </div>   
    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
        Solicitar Código
    </button>           
</form>
<div class="mt-10">
    <a href="{{ route('login') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">
        <span class="opacity-70 mr-4">
            Volver a login
        </span>
    </a>
</div>
                        
@endsection
        