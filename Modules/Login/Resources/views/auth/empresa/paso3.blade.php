@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro paso 3</div><br>
        <div class="text-muted font-weight-bold">Ingrese sus datos</div>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="nombre_empresa" value="{{ $nombre_empresa }}">
        <input type="hidden" name="rut" value="{{ $rut }}">
        <input type="hidden" name="razon_social" value="{{ $razon_social }}">
        <input type="hidden" name="bk_regiones_id" value="{{ $bk_regiones_id }}">
        <input type="hidden" name="bk_comunas_id" value="{{ $bk_comunas_id }}">
        <input type="hidden" name="direccion" value="{{ $direccion }}">
        <div class="form-group mb-5">
            <input id="name" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="name" placeholder="Nombre Encargado" required autocomplete="Nombre Encargado" autofocus>
        </div>

        <div class="form-group mb-5">
            <input id="telefono" type="number" class="form-control h-auto form-control-solid py-4 px-8" name="telefono" placeholder="9 12345678" required autocomplete="Numero de contacto" autofocus>
        </div>
        <div class="form-group mb-5">
            <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8" name="email" placeholder="Email" required autocomplete="Email" onchange="verificarMail(this.value)">
        </div>
        <div class="form-group mb-5">
            <input id="cargo" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="cargo" placeholder="Cargo" required autocomplete="Cargo">
        </div>
        <div class="form-group mb-5">
            <input id="password" type="password" placeholder="Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password" required autocomplete="new-password">
        </div>
        <div class="form-group mb-5">
            <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" id="myBtn" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            Agregar
        </button>
    </form>
@endsection
<div class="modal fade" id="correoExistente" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Hola! El correo que ingresaste ya esta siendo utilizado</h3>
           </div>
           <div class="modal-body">
                Por favor agregue otro correo
            </div>
           <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
<script>
    const verificarMail = (email) => {
    $.get('{{ asset('api/email-check') }}/'+email, (data, status) => {
        if (data == true) {
            $(document).ready(function()
            {
                $("#correoExistente").modal("show");
            });
            document.getElementById("myBtn").style.display = "none";
        }else if(data == false){
            alert('Correo utilizable');
            document.getElementById("myBtn").style.display = ''; 
        }
    });
}
</script>