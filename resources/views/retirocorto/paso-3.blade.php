@extends('layouts.public.master')
@section('content')
<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Agregar productos de combo N°{{$combo->id}}</h1>
          </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          {!!Form::open(['url' => 'retiro-corto/agregar-acceso', 'method' => 'POST','files'=>true])!!}
              <div class="form-group mb-1">
                <?php $count_combo = 0;?>
                  <label for="exampleTextarea">Productos Combo</label>
                  <select class="form-control" name="combo_residuo"  required>
                      <option value="">Seleccionar</option>
                      @foreach($combo->combo_residuo as $re)
                        @if(Session::has('combo_retiro_corto'))
                          <?php 
                            $count = 0;
                          ?>
                          @foreach(Session::get('combo_retiro_corto') as $residuos)
                            @if($residuos['id_combo'] == Session::get('combo_elegido')['id_combo'])
                              @if($residuos['combo_residuo'] == $re->id)
                                <?php 
                                  $count = 1;
                                  $count_combo = $count_combo+1;
                                ?>
                              @endif
                            @endif
                          @endforeach
                          @if($count == 0)
                            <option value="{{$re->id}}">{{$re->residuos->nombre}}</option>
                          @endif
                        @else
                          <option value="{{$re->id}}">{{$re->residuos->nombre}}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
              <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                        <label>Peso Aprox. (KG)</label>
                        <input type="number" name="peso" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-6">
                      <div class="form-group">
                          <label>Cantidad</label>
                          <input type="number" name="cantidad" value="1" class="form-control" placeholder="" readonly required>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label for="exampleTextarea">Motivo</label>
                  <textarea class="form-control" name="motivo" id="exampleTextarea" rows="2" required></textarea>
              </div>
              <div class="form-group">
                  <label>Fotos</label>
                  <input type="file" name="imagen[]" id="fotos-producto" multiple class="form-control" required>
              </div>
              <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Guardar Producto</button>
                </div>
              </div>
            {!!Form::close()!!}
        </div>

          <div class="col-12">
          <hr>
          <div class="col">
            <h5>Resumen de productos</h5>
          </div>
          <hr>
          <table class="table">
              <thead>
                  <tr>
                      <th>Producto</th>
                      <th class="text-center">Cantidad</th>
                      <th class="text-center">Mt3</th>
                      <th class="text-center"></th>
                  </tr>
              </thead>
              <tbody>
                  @if(Session::has('combo_retiro_corto'))
                      @foreach(Session::get('combo_retiro_corto') as $key => $solicitud)
                        @if($solicitud['id_combo'] == Session::get('combo_elegido')['id_combo'])
                        <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                                <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label" style="background-image: url('{{ asset('storage/'.$solicitud['imagen'])}}">
                                    </div>
                                </div>
                                <a href="#" class="text-dark text-hover-primary">{{ $solicitud['residuo'] }}</a>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">{{ $solicitud['cantidad'] }}</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">{{ $solicitud['mt3'] }} mt3</span>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ asset('borrar/combo/rc/'.$solicitud['id_sol'])}}" class="mr-2 font-weight-bolder">X</a>
                            </td>
                        </tr>
                        @endif
                      @endforeach                            
                  @endif
              </tbody>
          </table>
        </div>
        <div class="col-12">
          <div class="row">
            @if($combo->combo_residuo->count() == $count_combo)
              <div class="col-6" id="boton_siguiente">
                  <a class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" href="{{asset('retiro-corto/paso-2')}}" >Volver a Producto</a>
              </div>
            @else
              <div class="col-6" id="boton_siguiente">
                  <a class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" href="{{asset('retiro-corto/paso-3')}}" >Volver a Producto</a>
              </div>
            @endif
            <div class="col-6" id="boton_cancelar">
                <a href="{{ asset('/retiro-corto/cancelar') }}" class="btn btn-danger" onclick="return confirm('¿Quiere cancelar el retiro? Se borraran todos los datos ingresados')" style="background-color: red;border-color:red;">Cancelar</a>
            </div>
          </div>
        </div>
      </div>
  </center>
</div>

{{-- <script type="text/javascript">
  function BuscarComuna(id){
    $.get("{{ asset('tienda/venta-corta/buscar-comuna') }}/"+id,function(response, compania){
        $("#comuna_select").empty();
        $("#comuna_select").append(`<option value="0">Seleccionar</option>`);
        response.forEach(element => {
          $("#comuna_select").append(`<option value="${element.id}"> ${element.nombre} </option>`);
        });
    });
  }


</script> --}}
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