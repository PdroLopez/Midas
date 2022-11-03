@extends('layouts.public.master')
@section('content')

<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Tipo de Retiro</h1>
          </div>
      </div>
      <hr>
        {!!Form::open(['url' => 'retiro-corto/agregar-tiporetiro', 'method' => 'POST','files'=>true])!!}
      <div class="row">
                    <div class="col-12">
            <div class="col">
              <h5>Ingrese el acceso</h5>
            </div>
            <hr>
                <div class="form-group mb-1">
                    <label for="exampleTextarea">Comentario</label>
                    <textarea class="form-control" name="comentario" id="exampleTextarea" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Fotos</label>
                    <input type="file" name="imagen[]" id="fotos-producto" multiple class="form-control" required>
                </div>
          </div>
          <div class="col-12">
            <div class="col">
              <h5>Ingrese el tipo de retiro</h5>
            </div>
            <hr>
                <div class="form-group">
                    <label for="tiporetiro">Retiro</label>
                    <select class="form-control" name="tiporetiro" required>
                        <option value="" selected>Seleccionar</option>
                        @foreach($horario as $hrs)
                            <option value="{{ $hrs->id }}">{{ $hrs->nombre }}: {{ $hrs->hora }}Hrs (${{ $hrs->precio }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="horario">Horario</label>
                    <select class="form-control" name="horario" required>
                        <option value="">Seleccionar</option>
                        @foreach($hr_dia as $hora)
                            <option value="{{ $hora->id }}">{{ $hora->nombre }}</option>
                        @endforeach
                    </select>
                </div>
          </div>
          <div class="col-12">
                <hr>
                <div class="col-12">
                  <h5>Confirmar Dirección</h5>
                </div>
                <hr>
                @if(Auth::check())
                    <div class="col-12" >
                      <b>Elija una dirección</b><br>
                      <select name="bk_direccionuser_id" class="form-control">
                          <option value="">Seleccionar</option>
                          @foreach($direccion as $dir)
                            <option value="{{$dir->id}}">{{$dir->nombre}},@if($dir->bk_comunas_id != null){{$dir->comuna->nombre}}@endif</option>
                          @endforeach
                      </select>
                    </div>
                    <br>
                    <b>¿Quiere escribir una nueva dirección?</b><br>
                    <div class="form-group">
                        <input id="si_confirmo" type="radio" name="confirmar_direccion" value="1" checked="checked" onclick="confirmarFunction(this.value)">
                        <label>No</label>
                        <input id="no_confirmo" type="radio" name="confirmar_direccion" value="2" onclick="confirmarFunction(this.value)">
                        <label>Si</label>
                    </div>
                @else
                  <div class="col-12" >
                    <b>¿Esta es la dirección del retiro?</b><br>
                    @if (Session::has('sesion_datos_retiro'))
                      -{{Session::get('sesion_datos_retiro')[0]['direccion']}},
                      @foreach($comunas as $comun)
                        @if($comun->id == Session::get('sesion_datos_retiro')[0]['bk_comunas_id'])
                          {{$comun->nombre}}.
                        @endif
                      @endforeach
                    @endif
                  </div>
                  <div class="form-group">
                        <input id="si_confirmo" type="radio" name="confirmar_direccion" value="1" checked="checked" onclick="confirmarFunction(this.value)">
                        <label>Si</label>
                        <input id="no_confirmo" type="radio" name="confirmar_direccion" value="2" onclick="confirmarFunction(this.value)">
                        <label>No</label>
                  </div>
                @endif
                <div class="col-12" id="div_cambiar_direccion" style="display: none">
                  <div class="form-group">
                      <label>Región</label>
                      <select name="bk_regiones_id" class="form-control" onchange="BuscarComuna(this.value);">
                          {{-- <option value="0">Seleccionar</option> --}}
                          @foreach($region as $re)
                            <option value="{{$re->id}}" selected>{{$re->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                    <div class="form-group">
                  <label>Comuna</label>
                      <div class="input-group">
                        <select name="bk_comunas_id" id="comuna_select" class="form-control">
                            <option value="0">Seleccionar</option>
                            @foreach($comunas as $com)
                            <option value="{{$com->id}}">{{$com->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Dirección</label>
                      <input name="direccion" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                      <label>Algún detalle de Dirección</label>
                      <input name="detalle" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="row">
                    <div class="col-6" id="boton_siguiente">
                        <button class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Siguiente Paso</button>
                    </div>
                    <div class="col-6" id="boton_cancelar">
                        <a href="{{ asset('/retiro-corto/cancelar') }}" class="btn btn-danger" onclick="return confirm('¿Quiere cancelar el retiro? Se borraran todos los datos ingresados')" style="background-color: red;border-color:red;">Cancelar</a>
                    </div>
                </div>
          </div>
      </div>
        {!!Form::close()!!}
  </center>
</div>

<script type="text/javascript">
  function confirmarFunction(id){
      if(id == 2){
        document.getElementById('div_cambiar_direccion').style.display = "block";
      }else{
        document.getElementById('div_cambiar_direccion').style.display = "none";
      }
  }
</script>
<script type="text/javascript">
  function BuscarComuna(id){
    $.get("{{ asset('retiro-corto/buscar-comuna') }}/"+id,function(response, compania){
        $("#comuna_select").empty();
        $("#comuna_select").append(`<option value="0">Seleccionar</option>`);
        response.forEach(element => {
          $("#comuna_select").append(`<option value="${element.id}"> ${element.nombre} </option>`);
        });
    });
  }


</script>
<script> 
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        document.getElementById("boton_siguiente").style.padding="0%";
        document.getElementById("boton_cancelar").style.padding="0%";
      }else{
        document.getElementById("boton_siguiente").style.padding="0% 0% 0% 34%";
        document.getElementById("boton_cancelar").style.padding="0% 40% 0% 0%";
      }
</script>



@endsection