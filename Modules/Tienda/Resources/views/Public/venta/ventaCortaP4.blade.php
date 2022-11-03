@extends('tienda::layouts.public.master')
@section('tienda::content')
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
            <h1>Resumen de la Compra</h1>
          </div>
      </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row">
              <div class="col-6" id="div_img">
                  <div class="card-body"> 
                        @if ($producto->id == 19)
                          {{-- <img class="card-img-top" style="width: 30%;" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen') }}" alt="Card image cap">
                          <img class="card-img-top" style="width: 30%;" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen2') }}" alt="Card image cap"> --}}
                          <img class="card-img-top" id="img_1" src="{{ asset('productos.png') }}" alt="Card image cap">
                          {{-- <img class="card-img-top" id="img_2" src="{{ asset('imagenventacorta.jpeg') }}" alt="Card image cap"> --}}
                            {{-- <script>
                            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                                  document.getElementById("img_1").style.width="20%"
                                  // document.getElementById("img_2").style.width="20%"
                                }else{
                                  document.getElementById("img_1").style.width="40%"
                                  // document.getElementById("img_2").style.width="40%"
                                }
                            </script> --}}
                        @endif
                        {{-- https://picsum.photos/200/300 --}}
                  </div>
              </div>
              <div class="col-6" id="div_descripcion">
                  <div class="card-body" style="font-size:12px;">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    {{-- <p class="card-text">{{$producto->descripcion}}</p> --}}
                    {!!$producto->caracteristicas!!}
                      <h5 class="card-title">Datos Comprador</h5>
                      @if (Session::has('sesion_comprador_externo_new'))
                        <p class="card-text">
                          Nombre: <strong>{{Session::get('sesion_comprador_externo_new')->nombre}}</strong><br>
                          Celular: <strong>+569 {{Session::get('sesion_comprador_externo_new')->telefono}}</strong><br>
                          Dirección: <strong>{{Session::get('sesion_comprador_externo_new')->direccion}} @if(Session::get('sesion_comprador_externo_new')->bk_comunas_id != null),{{Session::get('sesion_comprador_externo_new')->comuna->nombre}} @endif @if(Session::get('sesion_comprador_externo_new')->bk_regiones_id != null), {{Session::get('sesion_comprador_externo_new')->region->nombre}} @endif </strong>
                          @if(Session::get('sesion_comprador_externo_new')->detalle != null)
                          <br>Detalle: <strong>{{Session::get('sesion_comprador_externo_new')->detalle}}</strong>
                          @endif
                        </p>

                      @else
                        <p class="card-text">
                          Nombre: <strong></strong><br>
                          Celular: <strong></strong><br>
                          Dirección: <strong></strong>
                        </p>
                      @endif
                    <h5 class="card-title">Cantidad y Forma de Pago</h5>
                    @if (Session::has('sesion_pago_externo')) 
                       <p class="card-text">Valor Unitario: <strong>${{number_format(Session::get('sesion_pago_externo')[0]['valor_unitario'], 0, ',', '.')}}</strong><br>
                          Cantidad: <strong>{{number_format(Session::get('sesion_pago_externo')[0]['cantidad'], 0, ',', '.')}}</strong><br>
                          @if(Session::get('sesion_pago_externo')[0]['cobertura'] == '1')
                          Despacho MidasChile(Valor Comuna): <strong>${{number_format(Session::get('sesion_pago_externo')[0]['despacho_valor'], 0, ',', '.')}}</strong><br>
                          @else
                           <b>Envio por pagar via Starken, nos comunicaremos contigo.</b><br>
                          @endif
                          Valor Total: <strong>${{number_format(Session::get('sesion_pago_externo')[0]['valor_total'], 0, ',', '.')}}</strong><br>
                          Forma de Pago: 
                        <strong>
                        @if (Session::get('sesion_pago_externo')[0]['creditcard'] == 'webpay')
                          WebPay Transferencia Electronica </strong></p>
                          <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a style="color:blue" data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                          {{-- <a href="{{ asset('/tienda/venta-corta/final-compra-webpay') }}" class="btn btn-primary">Pagar</a>  --}}
                          
                          <form method="post" action={{$response->url}}>
                          <input  name="token_ws" type="hidden" value={{$response->token}} >
                          <div class="row">
                            <div class="col-6" style="padding: 0% 0% 0% 25%;">
                              <button id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;" class="btn btn-primary" type="submit">Pagar</button>
                            </div>
                            <div class="col-6" style="padding: 0% 25% 0% 0%;">
                               <a href="{{ asset('/tienda/venta-corta/cancelar') }}" onclick="return confirm('¿Quiere cancelar la compra? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                            </div>
                          </div>
                        </form>

                        @elseif(Session::get('sesion_pago_externo')[0]['creditcard'] == 'efectivo')
                         Efectivo </strong></p>
                         <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                         
                         <div class="row">
                            <div class="col-6" style="padding: 0% 0% 0% 25%;">
                              <a href="{{ asset('/tienda/venta-corta/final-compra/'.$response) }}" class="btn btn-primary" id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;">Confirmar Compra</a>
                            </div>
                            <div class="col-6" style="padding: 0% 25% 0% 0%;">
                               <a href="{{ asset('/tienda/venta-corta/cancelar') }}" onclick="return confirm('¿Quiere cancelar la compra? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                            </div>
                          </div>

                        @elseif(Session::get('sesion_pago_externo')[0]['creditcard'] == 'transbank')
                          Pos Móvil Transbank </strong></p>
                          <p><input type="checkbox" name="terminos_condiciones" id="terminos_condiciones_id" onclick="checked_tyc();" value="1"><label for="terminos_condiciones"> He leido y acepto los <a style="color:blue" data-toggle="modal" data-target="#terminos_y_condiciones">Terminos y Condiciones</a></label></p>
                          <div class="row">
                            <div class="col-6" style="padding: 0% 0% 0% 25%;">
                              <a href="{{ asset('/tienda/venta-corta/final-compra/'.$response) }}" class="btn btn-primary" id="divpagar" style="display: none; color: #FFFFFF;background-color: #419f00;border-color: #419f00;">Confirmar Compra</a>
                            </div>
                            <div class="col-6" style="padding: 0% 25% 0% 0%;">
                               <a href="{{ asset('/tienda/venta-corta/cancelar') }}" onclick="return confirm('¿Quiere cancelar la compra? Se borraran todos los datos ingresados')" class="btn btn-danger" style="background-color: red;border-color:red;">Cancelar</a>
                            </div>
                          </div>
                           
                         

                        @endif
                       
                    @else
                       <p class="card-text">Valor Unitario: <strong>${{number_format(0, 0, ',', '.')}}</strong></p>
                      <p class="card-text">Cantidad: <strong>${{number_format(0, 0, ',', '.')}}</strong></p>
                      <p class="card-text">Valor Total: <strong>${{number_format(0, 0, ',', '.')}}</strong></p>
                      <p class="card-text">Forma de Pago: <strong>Ninguno</strong></p>
                    @endif
                    @include('tienda::Public.venta.terminos_y_condiciones')
                  </div>
              </div>
              <script>
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                      document.getElementById("div_descripcion").className="col-12";
                      document.getElementById("div_img").className="col-12";
                      document.getElementById("div_descripcion").style.padding="0%";
                      document.getElementById("div_img").style.padding="0%";
                    }else{
                      document.getElementById("div_img").className="col";
                      document.getElementById("div_descripcion").className="col";
                      document.getElementById("div_img").style.padding="3% 0% 0% 15%";
                      document.getElementById("div_descripcion").style.padding="0% 20% 0% 0%";
                    }
                </script>
            </div>
        </div>
    </div> 
</div>
    </center>
</div>

@endsection