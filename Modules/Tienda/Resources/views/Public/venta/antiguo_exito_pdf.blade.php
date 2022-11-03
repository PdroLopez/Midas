<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body{
  background-color:#EFF8FF; 
}
h1, p{
  margin:0px;  
}
.main-section{
  background-color: #FFF;
  border: 1px solid #6eaadb;
}
.header{
  background-color: #6eaadb;
  padding:30px 15px 20px 15px ;  
  color:#fff;
}
.content{
  padding:20px 15px 20px 15px;
}
th{
  background-color: #6eaadb;
  color: #fff;  
  text-align: right;
}
.table td:nth-child(1),
.table th:nth-child(1){
  text-align:left; 
}
.lastSection{
  padding: 20px 15px 30px 15px;
}
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row main-section">
                    <div class="col-md-12 col-sm-12 header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1> MIDAS CHILE</h1>
                                {{-- <h1><i class="fa fa-cloud" aria-hidden="true"></i> MIDAS CHILE</h1> --}}
                                
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p>Comprobante  #{{ $transaccion->codigo }}</p>
                                <span>{{ date('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 content">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p>Cliente</p>
                                <p><strong> {{ $transaccion->ventas_fuera->nombre }}</strong></p>
                                <p>Dirección</p>
                                <p> <strong>{{ $transaccion->ventas_fuera->direccion }}</strong></p>
                                <p>Detalle</p>
                                <p> <strong>{{ $transaccion->ventas_fuera->detalle }}</strong></p>
                            </div>
                            {{-- <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>From</p>
                                <p>ShopName</p>
                                <p>Shop Add. 555</p>
                                <p>Los Angel USA</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-right">
                          <table class="table">
                              <thead>
                                <tr>
                                  <th>Producto</th>
                                  <th class="text-center"></th>
                                  <th>Cantidad</th>
                                  
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($ventas as  $venta)
                                    <tr>
                                        <td class="">{{ $venta->venta->producto->nombre}}</td>
                                        <td colspan="1"></td>
                                        <td class="">{{ $venta->venta->cantidad }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                  <th colspan="3" style="text-align: right;">Total:</td>
                                  <th>$<strong>{{ $transaccion->total }}</strong></td>
                                </tr>
                              </tbody>
                          </table>
                    </div>
                    <div class="col-md-12 col-sm-12 lastSection">
                        <p>
                          {{-- Lorem ipsum dolor sit amet, <b>consectetur adipisicing elit, </b>sed do eiusmod --}}
                          En MidasChile, todas tus compras tienen el beneficio de "satisfacción garantizada"; esto significa que si no quedaste conforme con un producto o no te gustó, puedes solicitar, dentro de los primeros 15 días de efectuada la compra, la devolución del producto o la anulación de la compra y devolución del dinero, según el medio de pago utilizado.

Si quieres cambiar o devolver un producto, comunícate con nosotros en nuestro call center al teléfono 600 600 4020 opción 2; también puedes escribir a contactosodimac@sodimac.cl, o a través de la cuenta Twitter @midaschile. Si lo prefieres, puedes venir a cualquiera de nuestras tiendas con el producto. 
                      </p><br>
                      <p>
                        Recuerda que es muy importante que, antes de realizar la compra, verifiques las dimensiones del producto y las dimensiones físicas del lugar donde lo instalarás, evitando con esto problemas al momento de la entrega. Tus productos podrán ser despachados de lunes a sábado entre 9:00 y 21:00 horas, y de acuerdo a las condiciones pactadas al momento de la compra. Verifica que el producto corresponda a lo que compraste y que se encuentra en perfectas condiciones, antes de firmar la guía de despacho y aceptarla. El despacho no considera el armado o instalación de productos, ni el uso de cuerdas u otro elemento para levantar o ingresar los productos a pisos superiores.
                      </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

