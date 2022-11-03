@extends('layouts.public.master')
@section('content')
<script type="text/javascript">
  function checked_tyc(){
     check = document.getElementById("terminos_condiciones_id").checked;
     if(check === true){
        document.getElementById("divpagar").style.display = "block";
     }else{
        document.getElementById("divpagar").style.display = "none";
     }
  }
</script>
<div class="content">
    <center>
      <div class="row">
          <div class="col">
            <h1>Resumen del Retiro</h1>
          </div>
      </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row">
              <div class="col-12" id="div_descripcion">
                  <div class="card-body" style="font-size:12px;">
                      <h5 class="card-title">Datos Solicitador</h5><hr>
                        <p class="card-text">
                          Nombre: <strong>{{$boleta->nombre}}</strong><br>
                          Celular: <strong>+569 {{$boleta->telefono}}</strong><br>
                          Dirección: <strong>{{$boleta->direccion_rc}}, {{$boleta->comuna->nombre}}.</strong>
                          @if($boleta->detalle != null)
                          <br>Detalle:<strong>{{$boleta->detalle}}</strong>
                          @endif
                        </p>
                        <div class="col-12">
                          <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $mt3 = 0;
                                      $totalproducto = 0;
                                      $mt3_total = 0;
                                      $mt3_valor_total = 0;
                                      $total_combos = 0;
                                    ?>
                                    @if(Session::has('prod_retiro_corto'))
                                        <?php
                                          $totalproducto = 29990;
                                          $mt3_valor_total = 29990;
                                        ?>
                                        @foreach(Session::get('prod_retiro_corto') as $key => $solicitud)
                                          <tr>
                                              <td class="text-center align-middle">
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
                                                  $totalproducto  = $totalproducto+$valor_mt3;
                                                  $mt3_valor_total = $mt3_valor_total+$valor_mt3;
                                                ?>
                                              @endif
                                              <td class="text-center align-middle">
                                                  <span class="mr-2 font-weight-bolder">{{ $solicitud['cantidad'] }}</span>
                                              </td>
                                              <td class="text-center align-middle">
                                                  <span class="mr-2 font-weight-bolder">{{ $solicitud['mt3'] }} mt3</span>
                                              </td>
                                          </tr>
                                        @endforeach                            
                                    @endif
                                    @if(Session::has('combo_retiro_elegidos'))
                                      @foreach(Session::get('combo_retiro_elegidos') as $key => $comboele)
                                        <?php
                                          $total_combos = $total_combos+$comboele['valor'];
                                          $totalproducto = $totalproducto+$total_combos;
                                        ?>
                                          <tr>
                                              <td class="text-center align-middle">
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
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                          <tr>
                                              <td class="text-center align-middle">
                                                 Total mt3 a retirar
                                              </td>
                                              <td class="text-center align-middle">
                                                  {{$mt3_total}} mt3
                                              </td>
                                          </tr>
                                </tbody>
                            </table>
                          </div>
                    <h5 class="card-title">Acceso</h5>
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50%;">Imagen</th>
                                <th class="text-center" style="width: 50%;">Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">
                                    <img style="width: 150px;" src="{{ asset('storage/'.$acc->url)}}"></img>
                                </td>
                                <td class="text-center align-middle">
                                   {{ $acceso->comentario}}
                                </td>
                            </tr>                           
                        </tbody>
                    </table>
                      <h5 class="card-title">Cantidad y Forma de Pago</h5>
                     <p class="card-text">
                        Tipo Retiro: <strong>${{number_format($boleta->horario->precio, 0, ',', '.')}}</strong><br>
                        Productos: <strong>${{number_format($mt3_valor_total, 0, ',', '.')}}</strong><br>
                        Combos: <strong>${{number_format($total_combos, 0, ',', '.')}}</strong><br>
                        <?php
                          $total = $boleta->total;
                        ?>
                        @if ($confirmar_kit == 1)
                          Kit Reciclaje:<strong>${{number_format($producto->precio*$venta->cantidad, 0, ',', '.')}}</strong><br>
                          <?php
                            $total = $total+($producto->precio*$venta->cantidad);
                          ?>
                        @endif
                        Valor Total: <strong>${{number_format($total, 0, ',', '.')}}</strong><br>
                        Forma de Pago: 
                      <strong>
                      @if ($boleta->tipo_pago == 'webpay')
                        WebPay Transferencia Electronica </strong></p>
                        <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a style="color:blue" data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                        <form method="post" action={{$response->url}}>
                        <input  name="token_ws" type="hidden" value={{$response->token}} >
                        <div class="row">
                          <div class="col-6" id="boton_siguiente">
                            <button id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;" class="btn btn-primary" type="submit">Pagar</button>
                          </div>
                          <div class="col-6" id="boton_cancelar">
                             <a href="{{ asset('/retiro-corto/cancelar/'.$boleta->id) }}" onclick="return confirm('¿Quiere cancelar la solicitud? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                          </div>
                        </div>
                      </form>
                      @elseif($boleta->tipo_pago == 'efectivo')
                       Efectivo </strong></p>
                       <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                       
                       <div class="row">
                          <div class="col-6" id="boton_siguiente">
                            <a href="{{ asset('/retiro/corto/final-compra/'.$response) }}" class="btn btn-primary" id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;">Confirmar Compra</a>
                          </div>
                          <div class="col-6" id="boton_cancelar">
                             <a href="{{ asset('/retiro-corto/cancelar/'.$boleta->id) }}" onclick="return confirm('¿Quiere cancelar la solicitud? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                          </div>
                        </div>
                      @elseif($boleta->tipo_pago == 'transbank')
                        Pos Móvil Transbank </strong></p>
                        <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a style="color:blue" data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                        <div class="row">
                          <div class="col-6" id="boton_siguiente">
                            <a href="{{ asset('/retiro/corto/final-compra/'.$response) }}" class="btn btn-primary" id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;">Confirmar Compra</a>
                          </div>
                          <div class="col-6" id="boton_cancelar">
                             <a href="{{ asset('/retiro-corto/cancelar/'.$boleta->id) }}" onclick="return confirm('¿Quiere cancelar la solicitud? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                          </div>
                        </div>
                      @endif
                    @include('tienda::Public.venta.terminos_y_condiciones')
                  </div>
              </div>
            </div>
        </div>
    </div> 
</div>
    </center>
</div>
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

