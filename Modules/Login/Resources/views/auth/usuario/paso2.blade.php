@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro paso 2</div><br>
        <div class="text-muted font-weight-bold">Ingrese sus datos</div>
    </div>
    <form method="POST" action="{{ asset('login/register/usuario/paso-3') }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <div class="form-group mb-5">
            <input id="name" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="name" placeholder="Nombre" required autocomplete="name" autofocus>
        </div>

        <div class="form-group mb-5">
            <input id="apellido" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="apellido" placeholder="Apellido" required autocomplete="apellido" autofocus>
        </div>
        <div class="form-group mb-5">
            <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8" name="email" placeholder="Email" required autocomplete="email" onchange="verificarMail(this.value)">
        </div>

        <button type="submit" id="myBtn" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            Siguiente
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