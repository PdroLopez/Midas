@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro paso 5</div><br>
        <div class="text-muted font-weight-bold">Ingrese sus datos</div>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="apellido" value="{{ $apellido }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="telefono" value="{{ $telefono }}">
        <input type="hidden" name="password" value="{{ $password }}">
        <input type="hidden" name="comunidades" value="{{ $comunidades }}">

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
            Agregar
        </button>
    </form>
@endsection
<script>
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
