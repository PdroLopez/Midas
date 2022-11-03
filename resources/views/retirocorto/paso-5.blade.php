@extends('layouts.public.master')
@section('content')
<style>
     .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
           -moz-appearance:none;
                appearance:none;
    }

    .cc-selector-2 input{
        position:absolute;
        z-index:999;
    }

    .visa{background-image:url('{{asset('/tarjeta.jpg')}}');}
    .mastercard{background-image:url('{{asset('/webpay.jpg')}}');}
    .efectivo{background-image:url('{{asset('/efectivo.png')}}');}

    .cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
    .cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
           -moz-filter: none;
                filter: none;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        width:100px;height:70px;
        -webkit-transition: all 100ms ease-in;
           -moz-transition: all 100ms ease-in;
                transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
           -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
                filter: brightness(1.8) grayscale(1) opacity(.7);
    }
    .drinkcard-cc:hover{
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
           -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
                filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    /* Extras */
    a:visited{color:#888}
    a{color:#444;text-decoration:none;}
    p{margin-bottom:.3em;}
    * { font-family:monospace; }
    .cc-selector-2 input{ margin: 5px 0 0 12px; }
    .cc-selector-2 label{ margin-left: 7px; }
    span.cc{ color:#6d84b4 }
</style>
<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Valor total y Forma de Pago</h1>
          </div>
      </div>
      <hr>
        
      <div class="row">
          <?php 
            $totalproducto = 0;
            $mt3 = 0;
            $mt3_total = 0;
            $mt3_valor_total = 0;
            $total_combos = 0;
          ?>
            @if(Session::has('prod_retiro_corto'))
              @foreach(Session::get('prod_retiro_corto') as $key => $solicitud)
                    <?php 
                        $totalproducto = 29990;
                        $mt3_valor_total = 29990;
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
              @endforeach                            
            @endif
            @if(Session::has('combo_retiro_elegidos'))
                @foreach(Session::get('combo_retiro_elegidos') as $key => $comboele)
                        <?php
                          $total_combos = $total_combos+$comboele['valor'];
                          $totalproducto = $totalproducto+$comboele['valor'];
                        ?>                        
                @endforeach                            
            @endif
          <div class="col-12">
                <div class="col-12">
                  <h5>Resumen de Valores</h5>
                </div>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">MOTIVO</th>
                            <th class="text-center">MONTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $total = 0;
                          $total = $totalproducto+Session::get('tipo_retiro_horario')['precio'];
                        ?>
                        <tr>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">Horario<br>({{Session::get('tipo_retiro_horario')['tiporetiro']}})</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">${{number_format(Session::get('tipo_retiro_horario')['precio'], 0, ',', '.')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">Productos y Combos</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">${{number_format($totalproducto, 0, ',', '.')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                <span class="mr-2 font-weight-bolder">TOTAL</span>
                            </td>
                            <td class="text-center align-middle">
                                <h4><b>${{number_format($total, 0, ',', '.')}}</b></h4>
                                <input type="hidden" value="{{$total}}" name="total_pago" id="total_pago_id">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                {!!Form::open(['url' => 'retiro-corto/agregar-solicitudrc', 'method' => 'POST','files'=>true])!!}
                <div class="col-12">
                  <h5>Agregar un {{$producto->nombre}}</h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" id="div_img">
                        <div class="card-body" style="font-size:12px;">
                            @if ($producto->id == 19)
                            <img style="width: 70%;" class="card-img-top" id="img_1" src="{{ asset('productos.png') }}" alt="Card image cap">
                          @endif
                        </div>
                    </div>
                    <div class="col" id="div_descripcion">
                          <div class="card-body" style="font-size:12px;">
                            <p class="card-text">Precio <strong>${{number_format($producto->precio, 0, ',', '.')}}</strong></p>
                            <input type="hidden" value="{{$producto->precio}}" name="precio_kit" id="precio_kit_id">
                            <p class="card-text">{{$producto->descripcion}}</p>
                            <p class="card-text">{!!$producto->caracteristicas!!}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                      <input id="si_confirmo" type="radio" name="confirmar_kit" value="1"  onclick="confirmarFunction(this.value)">
                      <label>Si</label>
                      <input id="no_confirmo" type="radio" name="confirmar_kit" value="2" onclick="confirmarFunction(this.value)" checked="checked">
                      <label>No</label>
                </div>
                <div class="form-group" id="div_cantidad" style="margin-left: 20%;margin-right: 20%;display: none;">
                      <label>Cantidad</label>
                      <input id="cant_confirmo" type="number" name="cantidad" value="1" min="1" oninput="confirmarCantFunction(this.value)" class="form-control">
                </div>
                <div class="col-12" id="div_cambiar_total">
                    
                </div>
                <hr>
                <div class="col-12">
                  <h5>Forma de Pago</h5>
                </div>
                <hr>
                <div class="form-group">
                  <div class="cc-selector-2">
                      <input id="visa2" type="radio" name="creditcard" value="transbank" onclick="cantProducto(this.value)" >
                      <label class="drinkcard-cc visa" for="visa2"></label>

                      <input id="efectivo" type="radio" name="creditcard" value="efectivo" onclick="cantProducto(this.value)">
                      <label class="drinkcard-cc efectivo" for="efectivo"></label>
                      <input  checked="checked" id="mastercard2" type="radio" name="creditcard" value="webpay" onclick="cantProducto(this.value)">
                      <label class="drinkcard-cc mastercard"for="mastercard2"></label>
                  </div>
                <br>
                </div>
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
  function confirmarFunction(id){
      if(id == 1){
        precio = document.getElementById('precio_kit_id').value;
        total_pago = document.getElementById('total_pago_id').value;
        total_final = parseInt(precio)+parseInt(total_pago);

        document.getElementById('div_cantidad').style.display = "block";
        document.getElementById('div_cambiar_total').innerHTML='<p><b><h4>TOTAL con Kit: $'+total_final+'</h4></b></p>';
      }else{
        document.getElementById('div_cambiar_total').innerHTML='';
        document.getElementById('div_cantidad').style.display = "none";

      }
  }
  function confirmarCantFunction(id){
    if (id>=1) {
        precio = document.getElementById('precio_kit_id').value;
        precio = precio*id;
        total_pago = document.getElementById('total_pago_id').value;
        total_final = parseInt(precio)+parseInt(total_pago);

        document.getElementById('div_cambiar_total').innerHTML='<p><b><h4>TOTAL con Kit: $'+total_final+'</h4></b></p>';
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

<script>
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          document.getElementById("div_descripcion").className="col-12";
          document.getElementById("div_img").className="col-12";
          document.getElementById("div_descripcion").style.padding="0%";
          document.getElementById("div_img").style.padding="0%";
        }else{
          document.getElementById("div_img").className="col-6";
          document.getElementById("div_descripcion").className="col-6";
          document.getElementById("div_img").style.padding="1% 0% 0% 15%";
          document.getElementById("div_descripcion").style.padding="2% 20% 0% 0%";
        }
</script>

@endsection