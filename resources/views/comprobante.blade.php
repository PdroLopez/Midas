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
  border: 1px solid;
  margin-right: 100px;
  margin-left: 100px;
  text-align: justify;
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
                    <div class="col-md-12 col-sm-12 header">
                      {{-- <font size="1"> --}}
                        <div class="row">
                            <table style="width: 100%">
                                <tr>
                                    <td><center><img src="{{ asset('img/midas1.png') }}" style="width: 60%"></center></td>
                                </tr>
                                <tr>
                                    <td>
                                      <center>
                                        <p>
                                          <b>LOGISTICA MIDAS LTDA.<br>
                                          RUT: 77.131.208-K</b><br>
                                          <font size="1">LOGISTICA, DISTRIBUCION, ALMACENAMIENTO, 
                                          MANIPULACION DE CARGA, EMBALAJE<br>
                                          Av. Juan de la Fuente 834 – Lampa, Santiago, Chile<br>
                                          Tel: (56-2) 2747 1487 – (56-2) 2738 6045</font>
                                        </p>
                                      </center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <table style="width: 100%">
                                <tr>
                                    <td style="text-align: center">
                                      <center><p><b>COMPROBANTE  N°TPC6053256657{{-- {{ $transaccion->codigo }} --}}</b></p></center>
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
                                      <p style="text-transform:uppercase;">: Maria Jose Araya Miranda{{-- {{ $transaccion->ventas_fuera->nombre }} --}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <p><b>DIRECCIÓN</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: Pintora Juana Lecaros 1637, Quillota{{-- {{ $transaccion->ventas_fuera->direccion }} --}}</p>
                                    </td>
                                </tr>
                                {{-- @if($transaccion->ventas_fuera->detalle != null) --}}
                                <tr>
                                    <td>
                                      <p><b>DETALLE</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: El Sendero{{-- {{ $transaccion->ventas_fuera->detalle }} --}}</p>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                                <tr>
                                    
                                    <td>
                                      <p><b>FECHA</b></p>
                                    </td>
                                    <td>
                                      <p style="text-transform:uppercase;">: 04-16-2021{{-- {{ $transaccion->ventas_fuera->detalle }} --}}</p>
                                    </td>
                                </tr>
                            </table>
                        </font>
                        </div>
                        <hr>
                        <div class="row">
                            <font size="1">
                          <table width="100%">
                              <thead>
                                <tr>
                                  <th>PRODUCTO</th>
                                  <th>CANTIDAD</th>
                                  <th>PRECIO</th>
                                </tr>
                              </thead>
                              <tbody>
                                {{-- @foreach($ventas as  $venta) --}}
                                    <tr>
                                        <td style="text-transform:uppercase;">Kit de reciclaje{{-- {{ $venta->venta->producto->nombre}} --}}</td>
                                        <td>1{{-- {{ $venta->venta->cantidad }} --}}</td>
                                        <td>$21990</td>
                                    </tr>
                                {{-- @endforeach --}}
                              </tbody>
                          </table>
                      </font>
                        </div>
                        <hr>
                        <div class="row">
                            <font size="1">
                          <table style="width: 100%">
                                <tr>
                                    <td style="text-align: right">
                                      <b>TOTAL:</b>
                                    </td>
                                    <td style="text-align: center">
                                      $21990 {{-- {{ $transaccion->total }} --}}
                                    </td>
                                </tr>
                          </table>
                            {{-- <div class="col-md-8 col-sm-8 col-xs-8">
                              <p style="text-align: right;"><b>TOTAL:</b></p>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                              <p style="text-align: right;margin-right: 40px;">$21990</p>
                            </div> --}}
                            <br><br>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <center><p><b>FORMA DE PAGO</b></p></center>
                            </div>
                            <br><br>
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                      <b>TIPO DE PAGO</b>
                                    </td>
                                    <td>
                                     <p style="text-transform:uppercase;">: webpay{{-- {{ $transaccion->ventas_fuera->direccion }} --}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <b>TOTAL PAGADO</b>
                                    </td>
                                    <td>
                                     <p style="text-transform:uppercase;">: $21990{{-- {{ $transaccion->ventas_fuera->detalle }} --}}</p>
                                    </td>
                                </tr>
                          </table>
                            <br><br>
                            <br><br>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p><b>FIRMA:</b></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p style="text-transform:uppercase;"></p>
                            </div>
                            </font>                              
                        </div>
                        <hr>
                    <div class="row" style="margin-right: 15px; margin-left: 10px;">
                      <p style="text-align: justify;"><font style="font-size: xx-small;">
                          En MidasChile., todas tus compras tienen el beneficio de “satisfacción garantizada”; esto significa que, si no quedaste conforme con un producto o no te gusto, puedes solicitar, dentro de los primeros 15 días de efectuada la compra, la devolución del producto o la anulación de la compra y devolución del dinero, según el medio de pago utilizado. Si quieres realizar algún cambio, comunícate con nosotros al teléfono (56 2) 2747 1487; también puedes escribirnos a contacto@midaschile.cl, o a través de la cuenta de Instagram @midaschile.
                      </font></p>
                      <br><br>
                      <p style="text-align: justify;"><font style="font-size: xx-small;">
                        Recuerda que tus productos podrán ser despachados de lunes a viernes entre 9:00 y 19:00 horas y de acuerdo a las condiciones pactadas al momento de la compra. Verifica que el producto corresponda a lo que compraste y que se encuentre en perfectas condiciones.<br>El despacho no considera el armado o instalación de los productos.
                      </font></p>
                    </div>
                    <div class="row" style="margin-right: 20px;margin-top: 100px; margin-left: 20px;">
                      <center><p><font size="2">
                      RECICLAMOS FUTURO CON ENERGIAS LIMPIAS<br>
                      WWW.MIDASCHILE.CL<br>
                      
                      @switch(date('m'))
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
                      {{ date('d, Y H:i') }}
                    </font></p></center>
                  </div>
                {{-- </font> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>

