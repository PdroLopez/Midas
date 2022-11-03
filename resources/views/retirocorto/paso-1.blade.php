@extends('layouts.public.master')
@section('content')

    <script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWBZH35d3KInFEPtoHnQ8M03zYgj0LG7A&callback=initAutocomplete&libraries=places&v=weekly"
defer
></script>

<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Ingrese los datos del solicitante</h1>
          </div>
      </div>
      <div class="row">
        <div class="col">
          {!!Form::open(['url' => 'recopilar/datos/retiro', 'method' => 'POST','files'=>true])!!}
              <div class="form-group">
                <label>Nombre Completo</label>
                <input name="nombre" type="text" class="form-control" placeholder="" required>
              </div>
              <div class="form-group">
                <label>Celular</label>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button class="btn btn-default" >+ 56 9</button>
                  </div>
                  <input name="telefono" type="text" pattern=".{8,8}" maxlength="8" class="form-control" placeholder="87654321" required>
                </div>

              </div>
              <div class="form-group">
                <label>Correo electrónico</label>
                <div class="input-group">
                  <input name="correo" type="text" class="form-control" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                      <label>Región</label>
                      <select name="bk_regiones_id" class="form-control" onchange="BuscarComuna(this.value);" required>
                          {{-- <option value="0">Seleccionar</option> --}}
                          @foreach($region as $re)
                            <option value="{{$re->id}}" selected>{{$re->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
              <div class="form-group">
                  <label>Comuna</label>
                  <div class="input-group">
                    <select name="bk_comunas_id" id="comuna_select" class="form-control" required>
                        <option value="0">Seleccionar</option>
                        @foreach($comunas as $com)
                        <option value="{{$com->id}}">{{$com->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label>Dirección</label>
                  <input name="direccion" type="text" class="form-control" placeholder="" required>
              </div>
              <div class="form-group">
                  <label>Algún detalle de Dirección</label>
                  <input name="detalle" type="text" class="form-control" placeholder="">
              </div>
              {{-- <div id="map"></div> --}}
              <div class="row">
                <div class="col-6" id="boton_siguiente">
                    <button class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Siguiente Paso</button>
                </div>
                <div class="col-6" id="boton_cancelar">
                    <a href="{{ asset('/retiro-corto/cancelar') }}" class="btn btn-danger" onclick="return confirm('¿Quiere cancelar el retiro? Se borraran todos los datos ingresados')" style="background-color: red;border-color:red;">Cancelar</a>
                </div>
              </div>
          {!!Form::close()!!}
        </div>
      </div>
  </center>
</div>

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