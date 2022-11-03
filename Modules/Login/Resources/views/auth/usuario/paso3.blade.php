@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro paso 3</div><br>
        <div class="text-muted font-weight-bold">Ingrese sus datos</div>
    </div>
    <form method="POST" action="{{ asset('login/register/usuario/paso-4') }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="apellido" value="{{ $apellido }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group mb-5">
            <input id="telefono" type="number" class="form-control h-auto form-control-solid py-4 px-8" name="telefono" placeholder="Telefono" required autocomplete="telefono" autofocus>
        </div>
        <div class="form-group mb-5">
            <input id="password" type="password" placeholder="Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password" required autocomplete="new-password">
        </div>
        <div class="form-group mb-5">
            <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" id="myBtn" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            Siguiente
        </button>
    </form>
@endsection