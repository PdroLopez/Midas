@extends('login::layouts.master')
@section('content')
<div class="mb-20">
    <h3>Midas Chile</h3>
    <div class="text-muted font-weight-bold">Ingrese codigo enviado por celular</div>
</div>
<form method="POST" action="{{ asset('login/register/telefono-codigo') }}">
    @csrf
    <input type="hidden" name="numero" value="{{ $num }}">
    <input type="hidden" name="telefono" value="{{ $phone }}">
    <div class="form-group mb-5">
        <input id="codigo" type="number" class="form-control h-auto form-control-solid py-4 px-8" name="codigo" placeholder="Ingrese código" required autocomplete="Ingrese código">
    </div>   
    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
        Ingresar
    </button>           
</form>
                        
@endsection
        