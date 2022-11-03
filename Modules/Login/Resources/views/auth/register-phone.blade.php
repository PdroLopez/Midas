@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Para finalizar su ingreso porfavor termine de llenar los datos</div>
    </div>
        <form method="POST" action="{{ asset('login/register/agregar-user-phone') }}">
            @csrf
            <div class="form-group mb-5">
                <input id="name" type="text" class="form-control h-auto form-control-solid py-4 px-8" name="name" placeholder="Nombre" required autocomplete="name" autofocus>
            </div>
            <div class="form-group mb-5">
                <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8" name="email" placeholder="Email" required autocomplete="email" onchange="verificarMail(this.value)">
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
            <div class="form-group mb-5">
                <input id="telefono" type="number" class="form-control h-auto form-control-solid py-4 px-8" name="telefono" placeholder="9 12345678" required autocomplete="telefono" autofocus value="{{ Session::get('telefono-register')['telefono'] }}">
            </div>
            
            <div class="form-group mb-5">
                <input id="password" type="password" placeholder="Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group mb-5">
                <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="form-group mb-5">
            <label>¿Pertenece a alguna comunidad?</label>
            <br>
            <input type="checkbox" class="form-check-input" id="pertenece" name="pertenece" onchange="desplegarSelect()" >
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
            <button type="submit" id="myBtn" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
                Registrar
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
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Hola! El rut que ingresaste no es valido</h3>
           </div>
           <div class="modal-body">
                Por favor agregue un rut valido
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

function select(id) {
    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        //console.log(data);
        var producto_select = '<option value="">Seleccione Comuna</option>'
        for (var i = 0; i < data.length; i++)
            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

       document.getElementById('comuna').innerHTML = producto_select;

    });
}

function verificarRut() {
    var r = document.getElementById('rut').value;
    var dv = document.getElementById('dv').value;
    if (r != '' && dv != '') {
        var rut = r+dv;
        if (rut != '') {
            $.get("{{asset('api/rut-verificar')}}/"+rut, function(data, status) {
                if (data == true) {
                    alert('Rut correcto');
                    document.getElementById("myBtn").style.display = ''; 
                }else if(data == false){
                    $(document).ready(function()
                    {
                        $("#mostrarmodal").modal("show");
                    });
                    document.getElementById("myBtn").style.display = "none";
                }
            });
        }
    }
}

</script>
<script>
    const desplegarSelect = () => {
        if (document.getElementById('pertenece').checked) {
            document.getElementById('comunidades').style.display = 'block';
        }else{
            document.getElementById('comunidades').style.display = 'none';
        }
    }
</script>