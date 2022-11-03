@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro de usuario particular</div>
    </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group mb-5">
                <input id="name" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="name" placeholder="Ingrese Nombres" required autocomplete="name" autofocus>
            </div>
            <div class="form-group mb-5">
                <input id="apellido" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="apellido" placeholder="Ingrese Apellidos" required autocomplete="apellido" autofocus>
            </div>
            <div class="form-group mb-5">
                <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8" name="email" placeholder="Ingrese Email" required autocomplete="email" onchange="verificarMail(this.value)">
            </div>
            <div class="form-group mb-5">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button class="btn btn-default" >+ 56 9</button>
                    </div>
                    <input id="telefono" name="telefono" type="text" pattern=".{8,8}" maxlength="8" class="form-control h-auto form-control-solid" placeholder="Ingrese Teléfono" required autocomplete="telefono" autofocus>
                </div>
            </div>
            <div class="form-group mb-5">
                <input id="pass1" type="password" placeholder="Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password" required autocomplete="new-password" onchange="verificarContrasena()">
            </div>
            <div class="form-group mb-5">
                <input id="pass2" type="password" placeholder="Confirmar Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password" onchange="verificarContrasena()">
            </div>
            <div class="form-group mb-5">
                <label>¿Pertenece a alguna comunidad?</label>
                <br>
                <input type="checkbox" class="form-check-input" id="pertenece" name="pertenece" onchange="desplegarSelect()" > Si
            </div>
            <br>
           <div class="form-group mb-5" id="comunidades" style="display: none">
                <select class="form-control h-auto form-control-solid py-4 px-8" name="comunidades" >
                    <option value="">Seleccione una comunidad</option>
                    @foreach($comunidades as $comunidad)
                        <option value="{{ $comunidad->id }}">{{ $comunidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-5">
              <select name="bk_regiones_id" id="region" class="form-control h-auto form-control-solid py-4 px-8" placeholder="Seleccione una Region" onchange="select(this.value)">

                <option value="">Seleccione una Región</option>
                @foreach($region as $regiones)
                    <option value="{{ $regiones->id }}">{{ $regiones->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-5">
                <select name="bk_comunas_id" id="comuna" class="form-control h-auto form-control-solid py-4 px-8" placeholder="Seleccione una Region">
                  <option value="">Seleccione una Comuna</option>
                </select>
            </div>
            <div class="form-group mb-5">
                {!!Form::text('direccion',null,['class'=>"form-control h-auto form-control-solid py-4 px-8", 'placeholder'=>"Ingrese dirección..." , 'required'])!!}
            </div>
            <button type="submit" id="myBtn" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
                Registrar
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
<div class="modal fade" id="correoExistente" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>¡Hola! El correo que ingresaste ya esta siendo utilizado</h3>
           </div>
           <div class="modal-body">
                Por favor agregue otro correo o intente recuperar la contraseña de su antiguo usuario, volviendo al login.
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
                // alert('Correo utilizable');
                document.getElementById("myBtn").style.display = ''; 
            }
        });
    }

    function verificarContrasena(){
        pass1 = document.getElementById('pass1').value;
        pass2 = document.getElementById('pass2').value;
        if(pass2 != ''){
            if(pass1 != pass2){
                alert('contraseñas no coinciden');
            }
        }
    }

    const desplegarSelect = () => {
        if (document.getElementById('pertenece').checked) {
            document.getElementById('comunidades').style.display = 'block';
        }else{
            document.getElementById('comunidades').style.display = 'none';
        }
    }

    function select(id) {
    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        //console.log(data);
        var producto_select = '<option value="">Seleccione Comuna</option>'
        for (var i = 0; i < data.length; i++)
            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

       document.getElementById('comuna').innerHTML = producto_select;

    });
}
</script>
