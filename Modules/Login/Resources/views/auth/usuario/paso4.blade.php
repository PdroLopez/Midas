@extends('login::layouts.master')
@section('content')
    <div class="mb-20">
        <h3>Midas Chile</h3>
        <div class="text-muted font-weight-bold">Registro paso 4</div><br>
        <div class="text-muted font-weight-bold">Ingrese sus datos</div>
    </div>
    <form method="POST" action="{{ asset('login/register/usuario/paso-5') }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="apellido" value="{{ $apellido }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="telefono" value="{{ $telefono }}">
        <input type="hidden" name="password" value="{{ $password }}">

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
            Siguiente
        </button>
    </form>
@endsection
<script>
    const desplegarSelect = () => {
        if (document.getElementById('pertenece').checked) {
            document.getElementById('comunidades').style.display = 'block';
        }else{
            document.getElementById('comunidades').style.display = 'none';
        }
    }
</script>