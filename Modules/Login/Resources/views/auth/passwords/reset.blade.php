@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Resetear nueva contraseña:</div>
    </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group mb-5">
                <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mb-5">
                <input id="password" type="password" class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mb-5">
                <input id="password-confirm" type="password" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
            </div>

            <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
                {{ __('Resetear Contraseña') }}
            </button>
        </form>
@endsection
