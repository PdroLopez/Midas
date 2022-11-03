@extends('layouts.public.master')
@section('content')

<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Registre los productos</h1>
          </div>
      </div>
      <div class="row">
              <div class="col-12" style="text-align: center;">
              <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarproducto" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;">Agregar Producto</button>
                  @if($combos->count() != 0)
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#elegircombo" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;margin-left: 30px;">Elegir Combo</button>
                  @endif
              <br>
              </div>
            @include('retirocorto.agregarproducto')
            @include('retirocorto.elegircombo')
        <div class="col-12">
        <hr>
          <table class="table">
              <thead>
                  <tr>
                      <th>Producto</th>
                      <th class="text-center">Cantidad</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    $mt3 = 0;
                    $total = 0;
                    $mt3_total = 0;
                    $mt3_valor_total = 0;
                    $total_combos = 0;
                  ?>
                  @if(Session::has('prod_retiro_corto'))
                      <?php
                        $total = 29990;
                        $mt3_valor_total = 29990;
                      ?>
                      @foreach(Session::get('prod_retiro_corto') as $key => $solicitud)
                        <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                                <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label" style="background-image: url('{{ asset('storage/'.$solicitud['imagen'])}}">
                                    </div>
                                </div>
                                <a href="#" class="text-dark text-hover-primary">{{ $solicitud['residuo'] }}</a>
                            </td>
                            <?php
                              $mt3 = $solicitud['mt3'];
                              $mt3_total = $mt3_total+$mt3;
                            ?>
                            @if($mt3_total > 2)
                              <?php
                                $mt3_restante = $mt3_total-2;
                                $valor_mt3 = ($mt3_restante*29990)/2;
                                $total  = $total+$valor_mt3;
                                $mt3_valor_total = $mt3_valor_total+$valor_mt3;
                              ?>
                            @endif
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">{{ $solicitud['cantidad'] }}</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">{{ $solicitud['mt3'] }} mt3</span>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ asset('borrar/sol/rc/'.$solicitud['id_sol'])}}" class="mr-2 font-weight-bolder">X</a>
                            </td>
                        </tr>
                      @endforeach                            
                  @endif
                  @if(Session::has('combo_retiro_elegidos'))
                      @foreach(Session::get('combo_retiro_elegidos') as $key => $comboele)
                        <?php
                          $total_combos = $total_combos+$comboele['valor'];
                          $total = $total+$total_combos;
                        ?>
                          <tr>
                              <td class="d-flex align-items-center font-weight-bolder">
                                  <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                      <div class="symbol-label" style="background-image: url('{{ asset('storage/'.$comboele['nombre'])}}">
                                      </div>
                                  </div>
                                  <a href="#" class="text-dark text-hover-primary">COMBO {{ $comboele['nombre']}}</a>
                              </td>
                              <td class="text-center align-middle">
                                  <span class="mr-2 font-weight-bolder">1</span>
                              </td>
                              <td class="text-center align-middle">
                                  <span class="mr-2 font-weight-bolder">Valor ${{number_format($comboele['valor'], 0, ',', '.')}}</span>
                              </td>
                              <td class="text-center align-middle">
                                  <a href="{{ asset('borrar/combo/rc/'.$comboele['id_combo'])}}" class="mr-2 font-weight-bolder">X</a>
                              </td>
                          </tr>                          
                      @endforeach                            
                  @endif
              </tbody>
          </table>
        </div>
        <div class="col-12">
          <table class="table">
              <thead>
                  <tr>
                      <th></th>
                      <th class="text-center"></th>
                  </tr>
              </thead>
              <tbody>
                        <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                               <span class="mr-2 font-weight-bolder">Total mt3 a retirar</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">{{$mt3_total}} mt3</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                               <span class="mr-2 font-weight-bolder">Valor total de mt3</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">${{number_format($mt3_valor_total, 0, ',', '.')}}</span>
                            </td>
                        </tr>
                         <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                               <span class="mr-2 font-weight-bolder">Valor Total Combos</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">${{number_format($total_combos, 0, ',', '.')}}</span>
                            </td>
                        </tr>
              </tbody>
          </table>
        </div>
        <div class="col-12">
          <div class="card-body">
              <p class="card-text"><h4>Total de Productos <strong>${{number_format($total, 0, ',', '.')}}</strong></h4></p>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-6" id="boton_siguiente">
            <a class="btn btn-primary" href="{{ asset('/retiro-corto/paso-4') }}" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Siguiente Paso</a>
        </div>
        <div class="col-6" id="boton_cancelar">
            <a href="{{ asset('/retiro-corto/cancelar') }}" class="btn btn-danger" onclick="return confirm('¿Quiere cancelar el retiro? Se borraran todos los datos ingresados')" style="background-color: red;border-color:red;">Cancelar</a>
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
<script type="text/javascript">
  function radioProducto(id){
      if(id == 0){
        document.getElementById('div_valoresnuevos').style.display = "block";
      }else{
        document.getElementById('div_valoresnuevos').style.display = "none";
      }
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