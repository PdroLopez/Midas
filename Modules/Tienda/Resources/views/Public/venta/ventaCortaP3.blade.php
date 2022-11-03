@extends('tienda::layouts.public.master')
@section('tienda::content')
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
            <h1>Elige la cantidad y Forma de Pago</h1>
          </div>
      </div>
      <div class="row">
        <div class="col">
          {!!Form::open(['url' => 'tienda/venta-corta/agregar/pago', 'method' => 'POST','files'=>true])!!}
          <input type="hidden" name="producto_id" value="{{$producto->id}}">
            <div class="form-group">
              <label>Valor unitario</label>
              <input type="number" name="valor_unitario" class="form-control" placeholder="" value="{{$producto->precio}}" id="valorunitario" readonly>
            </div>
            <div class="form-group" id="div_inputCant">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" oninput="calculo()" value="1" min="1" max="100" required id="cantidad">
            </div>
            @if($despacho->bk_cobertura_id == 1)
              <div class="form-group">
                <label>Costo Despacho MidasChile por Comuna</label>
                <input type="number" name="despacho_valor" class="form-control" placeholder="" value="{{$despacho->costo}}" id="despachovalor" readonly>
                <input type="hidden" name="cobertura" value="{{$despacho->bk_cobertura_id}}">
                <input type="hidden" name="despacho_id" value="{{$despacho->id}}">
              </div>
            @else
              <div class="form-group">
                <b>Envio por pagar via Starken, nos comunicaremos contigo.</b>
                <input type="hidden" name="despacho_valor" value="0" id="despachovalor">
                <input type="hidden" name="cobertura" value="{{$despacho->bk_cobertura_id}}">
                <input type="hidden" name="despacho_id" value="{{$despacho->id}}">
              </div>
            @endif
            @php
              $total_detodo = $producto->precio+$despacho->costo;
            @endphp
            <div class="form-group">
                <label for="pwd">Valor total</label>
                <input type="number" name="valor_total" class="form-control" placeholder="" value="{{$total_detodo}}" id="total" min="1" readonly>
              </div>
            <div class="form-group">
                <div class="cc-selector-2">
                    @if($despacho->bk_cobertura_id == 1)
                      <input id="visa2" type="radio" name="creditcard" value="transbank" onclick="cantProducto(this.value)" >
                      <label class="drinkcard-cc visa" for="visa2"></label>

                      <input id="efectivo" type="radio" name="creditcard" value="efectivo" onclick="cantProducto(this.value)">
                      <label class="drinkcard-cc efectivo" for="efectivo"></label>
                    @endif
                    <input  checked="checked" id="mastercard2" type="radio" name="creditcard" value="webpay" onclick="cantProducto(this.value)">
                    <label class="drinkcard-cc mastercard"for="mastercard2"></label>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-6" id="boton_siguiente">
                      <button class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Siguiente Paso</button> 
                    </div>
                    <div class="col-6" id="boton_cancelar">
                        <a href="{{ asset('/tienda/venta-corta/cancelar') }}" onclick="return confirm('¿Quiere cancelar la compra? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                    </div> 
                </div>   
            </div> 
          {!!Form::close()!!}
        </div>
      </div>
  </center>
</div>
{{--     <hr>

    <div class="row">
        <form action="/action_page.php">
            <div class="form-group">
              <label for="email">Valor unitario</label>
              <input type="email" class="form-control" placeholder="" value="23455" id="valorunitario">
            </div>
            <div class="form-group">
              <label for="pwd">cantidad</label>
              <input type="text" class="form-control" placeholder="" oninput="calculo()" value="1" id="cantidad">
            </div>
            <div class="form-group">
                <label for="pwd">Valor total</label>
                <input type="text" class="form-control" placeholder="" value="2342332" id="total">
              </div>
            <div class="form-group">
                <div class="cc-selector-2">
                    <input id="visa2" type="radio" name="creditcard" value="visa" />
                    <label class="drinkcard-cc visa" for="visa2"></label>
                    <input  checked="checked" id="mastercard2" type="radio" name="creditcard" value="mastercard" />
                    <label class="drinkcard-cc mastercard"for="mastercard2"></label>
                </div>
                <br>
                <hr>
                <a href="{{ asset('/tienda/venta-corta/producto/paso-4')}}" class="btn btn-primary">siguiente paso</a>
            </div> 
          </form> --}}
   

<script>
    function calculo(){

        valorunitario = document.getElementById("valorunitario").value;
        cantidad = document.getElementById("cantidad").value;
        despacho = document.getElementById("despachovalor").value;
        // Calculo del subtotal
        subtotal = ((parseInt(valorunitario*cantidad))+parseInt(despacho));
        document.getElementById("total").value = subtotal;
    }

    function cantProducto(val){
      document.getElementById("div_inputCant").innerHTML = "";
      if(val == 'webpay'){
        document.getElementById("div_inputCant").innerHTML = '<label>Cantidad</label>'+
        '<input type="number" name="cantidad" class="form-control" oninput="calculo()" value="1" min="1" max="100" required id="cantidad">';
        calculo();
      }else{
        document.getElementById("div_inputCant").innerHTML = '<label>Cantidad</label>'+
        '<input type="number" name="cantidad" class="form-control" oninput="calculo()" value="1" min="1" max="10" required id="cantidad">';
        calculo();
      }
    }

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        document.getElementById("boton_siguiente").style.padding="0%";
        document.getElementById("boton_cancelar").style.padding="0%";
      }else{
        document.getElementById("boton_siguiente").style.padding="0% 0% 0% 34%";
        document.getElementById("boton_cancelar").style.padding="0% 40% 0% 0%";
      }
</script>
@endsection