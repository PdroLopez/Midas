<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="custom.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body{
  background-color:#ffffff; 
}
h1, p{
  margin:0px;  
}
.main-section{
  background-color: #FFF;
  /*border: 1px solid #6eaadb;*/
/*  margin-right: 10px;
  margin-left: 10px;*/
}
.header{
  background-color: #fff;
  /*padding:30px 15px 20px 15px ;  */
}

.content{
  /*padding:20px 15px 20px 15px;*/
}
th{
  background-color: #fff;
  text-align: left;
  /*padding-block: 15px;*/
}
.table td:nth-child(1),
.table th:nth-child(1){
  text-align:left;
}
.lastSection{
  /*padding: 20px 15px 30px 15px;*/
}
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row main-section">
                    <div class="col-md-12 col-sm-12">
                      {{-- <font size="1"> --}}
                        <div class="row">
                            <table style="width: 100%">
                                <tr>
                                  <td><center><img src="{{ asset('img/midas1.png') }}" style="width: 60%"></center></td> 
                                  {{-- <td><center><img src="https://i.pinimg.com/564x/62/e5/8f/62e58fb450b38c876d03130976069ce4.jpg" style="width: 60%"></center></td>  --}}
                                </tr>
                                <tr>
                                    <td>
                                     <center>
                                      <p>
                                        <b>LOGISTICA MIDAS LTDA.<br>
                                        RUT: 77.131.208-K</b><br>
                                        <font style="font-size: xx-small;">LOGISTICA, DISTRIBUCION, ALMACENAMIENTO, 
                                        MANIPULACION DE CARGA, EMBALAJE<br></font>
                                        <font size="1">Av. Juan de la Fuente 834 – Lampa, Santiago, Chile<br>
                                        Tel: (56-2) 2747 1487 – (56-2) 2738 6045</font>
                                      </p>
                                    </center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <center>______________________________________</center><br>
                        <div class="row">
                            <table style="width: 100%">
                                <tr>
                                    <td style="text-align: center">
                                      <center><p><b>COMPROBANTE  N°{{ $venta->codigo }}</b></p></center>
                                    </td>
                                </tr>
                              </table>
                          <font size="1">
                            <table style="width: 100%">
                                <tr>
                                    <td colspan="2"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <p><b>CLIENTE</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: {{ $venta->ventas_fuera->nombre }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <p><b>DIRECCIÓN</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: {{ $venta->ventas_fuera->direccion }}  @if($venta->ventas_fuera->bk_comunas_id != null),{{$venta->ventas_fuera->comuna->nombre}} @endif @if($venta->ventas_fuera->bk_regiones_id != null), {{$venta->ventas_fuera->region->nombre}} @endif</p>
                                    </td>
                                </tr>
                                @if($venta->ventas_fuera->detalle != null)
                                <tr>
                                    <td>
                                      <p><b>DETALLE</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: {{ $venta->ventas_fuera->detalle }}</p>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>
                                      <p><b>FECHA</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: {{ $venta->created_at->format('d-m-Y') }}</p>
                                    </td>
                                </tr>
                            </table>
                          </font>
                        </div>
                        <center>______________________________________</center>
                        <div class="row">
                          <font size="1">
                          <table style="width: 100%">
                                <tr>
                                  <th>PRODUCTO</th>
                                  <th style="width: 30px;text-align: right;"></th>
                                  <th style="width: 40px;text-align: right;">CANTIDAD</th>
                                </tr>
                                <tr>
                                  <th>DESCRIPCIÓN</th>
                                  <th style="width: 30px;text-align: right;"></th>
                                  <th style="width: 40px;text-align: right;">PRECIO</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="width: 30px;text-align: right;"></td>
                                    <td style="width: 40px;text-align: right;">{{ $venta->cantidad }}</td>
                                </tr>
                                <tr>
                                    <td style="text-transform:uppercase;">{{ $venta->producto->nombre}}</td>
                                    <td style="width: 30px;text-align: right;">$</td>
                                    <td style="width: 40px;text-align: right;">{{ $venta->producto->precio}}</td>
                                </tr>
                          </table>
{{--                           <table width="100%">
                              <thead>
                                <tr>
                                  <th>PRODUCTO</th>
                                  <th>CANTIDAD</th>
                                  <th>PRECIO</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($ventas as  $venta)
                                    <tr>
                                        <td style="text-transform:uppercase;">{{ $venta->venta->producto->nombre}}</td>
                                        <td>{{ $venta->venta->cantidad }}</td>
                                        <td>{{ $venta->venta->producto->precio}}</td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table> --}}
                        </font>
                        </div>
                       <center>______________________________________</center>
                        <div class="row">
                          <font size="1">
                            <table style="width: 100%">
                              @if ($venta->bk_despacho_id != null)
                                @if($venta->despacho->bk_cobertura_id == 1)
                                  <tr>
                                      <td style="text-align: right;"><b>COSTO DESPACHO:</b></td>
                                      <td style="width: 70px;text-align: right;">$</td>
                                      <td style="width: 55px;text-align: right;">{{ $venta->despacho_valor}}</td>
                                  </tr>
                                @else
                                  <tr>
                                      <td style="text-align: right;"><b>COSTO DESPACHO:</b></td>
                                      <td colspan="2" style="text-align: right;">Envio por pagar via Starken</td>
                                  </tr>
                                @endif
                              @endif
                                <tr>
                                    <td style="text-align: right;"><b>TOTAL:</b></td>
                                    <td style="width: 70px;text-align: right;">$</td>
                                    <td style="width: 55px;text-align: right;">{{ $venta->total }}</td>
                                </tr>
                          </table>
                            <table style="width: 100%">
                                <tr>
                                    <td><b>FORMA DE PAGO</b></td>
                                    <td style="width: 1px;text-align: right;"></td>
                                    <td style="width: 50px;text-align: right;"></td>
                                    <td style="width: 55px;text-align: right;"></td>
                                </tr>
                                <tr>
                                    <td><b>TIPO DE PAGO</b></td>
                                    <td style="width: 1px;text-align: right;">:</td>
                                    <td style="width: 50px;text-align: right;"></td>
                                    <td>
                                      <p style="width: 55px;text-transform:uppercase;text-align: right;"> {{ $venta->tipo_pago}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>TOTAL @if($venta->estado == 0) A PAGAR @else PAGADO @endif</b></td>
                                    <td style="width: 1px;text-align: right;">:</td>
                                    <td style="width: 50px;text-align: right;">$</td>
                                    <td>
                                     <p style="width: 55px;text-transform:uppercase;text-align: right;">{{$venta->total}}</p>
                                    </td>
                                </tr>
                            @if($venta->estado == 0)
                                <tr>
                                    <td colspan="4" style="text-align: center;text-transform:uppercase;"><br>Recuerda realizar el pago al momento de recibir el producto</td>
                                </tr>
                            @endif
                          </table>
                            <br>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><b>FIRMA:</b></p>
                            </div>
                            <br>
                            </font>                             
                      </div>
                    <center>_________________________</center><br>
                    <div class="row">
                      <p style="text-align: justify;"><font style="font-size: xx-small;">
                          En MidasChile., todas tus compras tienen el beneficio de “satisfacción garantizada”; esto significa que, si no quedaste conforme con un producto o no te gusto, puedes solicitar, dentro de los primeros 15 días de efectuada la compra, la devolución del producto o la anulación de la compra y devolución del dinero, según el medio de pago utilizado. Si quieres realizar algún cambio, comunícate con nosotros al teléfono (56 2) 2747 1487; también puedes escribirnos a contacto@midaschile.cl, o a través de la cuenta de Instagram @midaschile.
                      </font></p>
                      <br>
                      <p style="text-align: justify;"><font style="font-size: xx-small;">
                        Recuerda que tus productos podrán ser despachados de lunes a viernes entre 9:00 y 19:00 horas y de acuerdo a las condiciones pactadas al momento de la compra. Verifica que el producto corresponda a lo que compraste y que se encuentre en perfectas condiciones.<br>El despacho no considera el armado o instalación de los productos.
                      </font></p>
                    </div>
                    <div class="row">
                      <br><br><br>
                      <center><p style="font-family:'Courier New',monospace;font-size: xx-small;">
                      RECICLAMOS FUTURO CON ENERGIAS LIMPIAS<br>
                      WWW.MIDASCHILE.CL<br>
                      @switch($venta->created_at->format('m'))
                      @case('01')Enero @break
                      @case('02')Febrero @break
                      @case('03')Marzo @break
                      @case('04')Abril @break
                      @case('05')Mayo @break
                      @case('06')Junio @break
                      @case('07')Julio @break
                      @case('08')Agosto @break
                      @case('09')Septiembre @break
                      @case('10')Octubre @break
                      @case('11')Noviembre @break
                      @case('12')Diciembre @break
                      @endswitch 
                      {{ $venta->created_at->format('d, Y H:i') }}
                    </p></center>
                  </div>
                {{-- </font> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>

