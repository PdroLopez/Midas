@extends('login::layouts.master')
@section('content')
<div class="mb-20">
    <h3>Midas Chile</h3>
    <div class="text-muted font-weight-bold">Ingresa tus datos para iniciar sesión:</div>
</div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group mb-5">
        <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-5">
        <input id="password" type="password" class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
       
        {{--            <div class="checkbox-inline ml-5"> <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
--}}

            {{-- <label class="form-check-label" for="remember">
                Recuérdame
            </label> --}}
        </div>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
        @endif
    </div>
    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
        {{ __('Login') }}
    </button>
    <br>
{{--     <span class="social-icons-twitter">
    <a href="{{ asset('login/register/login-telefono') }}" class="btn btn-secondary font-weight-bold px-9 py-4 my-3 mx-4" style="width: 285px;">
        <i class="fab fa-cellphone"></i>
        Ingresar con Numero de teléfono
    </a>
</span>
<span class="social-icons-facebook">
    <a href="{{ asset('login/sing-in/facebook') }}" class="btn btn-secondary font-weight-bold px-9 py-4 my-3 mx-4" style="width: 285px;">
        <i class="fab fa-facebook-f"></i>
        Ingresar con Facebook
    </a>
</span>
<span class="social-icons-twitter">
    <a href="{{ asset('login/sing-in/google') }}" class="btn btn-secondary font-weight-bold px-9 py-4 my-3 mx-4" style="width: 285px;">
        <i class="fab fa-google"></i>
        Ingresar con Google
    </a>
</span>
<span class="social-icons-twitter">
    <a href="{{ asset('login/instagram') }}" class="btn btn-secondary font-weight-bold px-9 py-4 my-3 mx-4" style="width: 285px;">
        <i class="fab fa-instagram"></i>
        Ingresar con Instagram
    </a>
</span> --}}

</form>
<div class="mt-10">
    <span class="opacity-70 mr-4">
        ¿No tienes una cuenta?
    </span>
    <a href="{{ route('register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">¡Registrate!</a>
</div>
@endsection
@if(Session::has('usuarioyaexisteingrese'))
<script src="{{ asset('metronic_7/demo1/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('metronic_7/demo1/dist/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#loginretiro").modal("show");
    });
</script>
@endif
<div class="modal fade" id="loginretiro" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>¡Hola! El correo que ingresaste ya esta registrado</h3>
           </div>
           <div class="modal-body">
                Ingrese con su usuario para continuar con el retiro.<br>
                Si no recuerda o no se sabe su contraseña, <b>verifique en su correo si tiene un mail de creación de usuario</b> o intente apretando <b>¿Olvidaste tu contraseña?</b>.
            </div>
           <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>

