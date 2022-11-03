<!DOCTYPE html>
<html>
  <style type="text/css">
      html {
      margin: 0;
    }

		.tabla-productos {
		  border-collapse: collapse;
		  border: 1px solid black;
		}
    /** Definir las reglas del encabezado **/
    header {
        position: fixed;
        top: 0cm;
        left: 1cm;
        right: 1cm;
        height: 2.5cm;

    }

    /** Definir las reglas del pie de página **/
    footer {
        position: fixed; 
        bottom: 0cm; 
        left: 1cm; 
        right: 1cm;
        height: 2cm;
    }
  </style>
  <head >
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TICKET PESAJE N°{{$ticket->id}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
       <header>
    		<div class="row">
		        <div class="col-12" align="left" style="margin-right:-20px">
		              <img src="{{ asset('img/midas1.png') }}" style="width:30%;"/>
		        </div>
		      </div>
           
        </header>

        <footer>
            <div class="row">
		        <div class="col-12" align="left" style="font-size: 12px;">
		              <p>
                        <b>MIDAS CHILE</b><br>
                        Av. Juan de la Fuente 834 – Lampa, Santiago, Chile<br>
                        Tel: (56-2) 2747 1487 – (56-2) 2738 6045
                      </p>
		        </div>
		      </div>
        </footer>
        <main>
		    <div class="container" style="margin-top: 10%;">
		      <div class="row">
		        <div class="col-12" align="center">
		              <h6 style="text-transform:uppercase;">TICKET DE PESAJE Nº {{$ticket->id}}</h6>
		        </div>
		      </div>
		    </div>
		    <br>
		    <div class="container">
		      <div class="row" style="margin-right: 0.5%;margin-left: 0.5%;">
		        <div class="col-12">
		            <TABLE style="width:100%; font-size: 12px;">
		                <TR>
		                    <TD style="width: 15%;">
		                    	CLIENTE
		                   </TD>
		                   <TD style="width: 45%;">
		            			: @if($boleta->empresas_id != null)
		                            {{ $boleta->empresas->nombre }}
		                        @else
		                            @if($boleta->user)
		                                {{ $boleta->user->name }} {{ $boleta->user->apellido }}
		                            @else
		                                {{ $boleta->nombre}}
		                            @endif
		                        @endif
		                    </TD>
		                    <TD style="width: 20%;">
		                    	FECHA 
		                   </TD>
		                   <TD style="width: 20%;">
		            			: {{ $boleta->fecha_hora }}
		                    </TD>
		                </TR>
		                <TR>
		                	<TD>
		                    	RUT
		                   </TD>
		                   <TD>
		            			: @if($boleta->empresas_id != null)
		                            {{ $boleta->empresas->rut }}
		                        @else
		                            @if($boleta->user)
		                                {{ $boleta->user->rut }}-{{ $boleta->user->dv}}
		                            @else
		                               No tiene rut
		                            @endif
		                        @endif
		                    </TD>
		                    <TD>
		                    	CONDUCTOR
		                   </TD>
		                   <TD>
		            			: @if ($boleta->chofer != null )
		                            {{$boleta->chofer->name}}
		                        @else
		                            Sin Chofer
		                        @endif
		                    </TD>
		                </TR>
		                <TR>
		                	<TD >
		                    	ORIGEN
		                   </TD>
		                   <TD >
		            			: @if($boleta->empresas_id != null)
		                            @if($boleta->bk_direcciones_empresas_id != null)
		                                @if($boleta->direccion_empresa != null)
		                                    {{ $boleta->direccion_empresa->nombre }}, 
		                                    @if ($boleta->direccion_empresa->bk_comunas_id != null)
		                                        {{ $boleta->direccion_empresa->comuna->nombre }},
		                                    @else
		                                        Sin Comuna,
		                                    @endif
		                                    @if ($boleta->direccion_empresa->bk_regiones_id != null)
		                                        {{ $boleta->direccion_empresa->region->nombre}}.
		                                    @else
		                                        Sin Región.
		                                    @endif
		                                @endif
		                            @endif
		                        @endif
		                        @if($boleta->users_id != null)
		                            @if($boleta->direccion != null)
		                                @if ($boleta->direccion->nombre != null)
		                                {{ $boleta->direccion->nombre }},
		                                @else
		                                Sin Calle,
		                                @endif
		                                @if ($boleta->direccion->bk_comunas_id != null)
		                                {{ $boleta->direccion->comuna->nombre }}, 
		                                @else
		                                 Sin Comuna, 
		                                @endif
		                                @if ($boleta->direccion->bk_regiones_id != null)
		                                    {{ $boleta->direccion->region->nombre }}.
		                                @else
		                                Sin Región.
		                                @endif
		                            @else
		                                {{ $boleta->direccion_rc }} {{ $boleta->detalle }},
		                                @if ($boleta->comuna_id != null)
		                                    {{ $boleta->comuna->nombre }}, 
		                                @else
		                                    Sin Comuna, 
		                                @endif
		                                Metropolitana de Santiago.
		                            @endif
		                        @endif
		                    </TD>
		                    <TD >
		                    	PATENTE
		                   </TD>
		                   <TD >
		            			: @if ($boleta->camiones != null )
		                            {{$boleta->camiones->patente}}
		                        @else
		                            Sin Camiones
		                        @endif
		                    </TD>
		                </TR>
		                <TR>
		                    <TD >
		                    	G. DESPACHO 
		                   </TD>
		                   <TD >
		            			: {{ $boleta->n_guia_despacho }}
		                    </TD>
		                    <TD >
		                    	N° CONTENEDOR
		                   </TD>
		                   <TD>
		            			: {{ $boleta->n_contenedor }}
		                    </TD>
		                </TR>
		            </TABLE>
		            <br>
		            <TABLE class="tabla-productos" style="width: 100%;font-size: 12px;">
		            	<thead style="font-size: 10px;">
		                	<tr  style="border: 1 solid;">
		                		<th class="tabla-productos" style="text-transform:uppercase;width: 2%;">ID</th>
		                		<th class="tabla-productos" style="text-transform:uppercase;width: 8%;">COD CAL</th>
		                        <th class="tabla-productos" style="text-transform:uppercase;width: 34%;">DESCRIPCIÓN</th>
		                        <th class="tabla-productos" style="text-transform:uppercase;width: 18%;">Peso Bruto(Kg)</th>
		                        <th class="tabla-productos" style="text-transform:uppercase;width: 19%;">Peso Envase(Kg)</th>
		                        <th class="tabla-productos" style="text-transform:uppercase;width: 19%;">Peso Neto(Kg)</th>
		                	</tr>
		            	</thead>
		            	<tbody style="font-size: 12px;">
		            		<?php 
		                        $total_peso_bruto = 0;
		                        $total_peso_interno  = 0;
		                        $total_peso_neto = 0; 
		                        $diferencia = 0; 
		                        $diferencia_cliente = 0; 
		                        $count_producto = 1;
		                    ?>
			            	@foreach($boleta->solicitudes as $producto)
				                <TR>
				                    <td class="tabla-productos">{{ $count_producto }}</td>
				                    <td class="tabla-productos"></td>
		                            @if ($producto->solicitud->Residuos_id != null)
		                                <td class="tabla-productos">{{ $producto->solicitud->residuos->nombre }}</td>
		                            @else
		                                @if($producto->solicitud->grupos_id != null)
		                                    <td class="tabla-productos">{{$producto->solicitud->grupo->nombre}}, {{$producto->solicitud->clasificacion->nombre}}</td> 
		                                @else
		                                    <td class="tabla-productos">{{$producto->solicitud->nombre}}</td> 
		                                @endif
		                            @endif
		                            <td class="tabla-productos">
		                                {{ $producto->solicitud->peso_bruto }}
		                            </td>
		                            <td class="tabla-productos">
		                                {{ $producto->solicitud->peso_interno }}
		                            </td>
		                            <td class="tabla-productos">
		                               {{ $producto->solicitud->peso_neto }}
		                            </td>
				                </TR>
				                <?php 
		                            $total_peso_bruto = $total_peso_bruto+$producto->solicitud->peso_bruto;
		                            $total_peso_interno  = $total_peso_interno+$producto->solicitud->peso_interno;
		                            $total_peso_neto = $total_peso_neto+$producto->solicitud->peso_neto;
		                            $count_producto = $count_producto+1;
		                            $diferencia_cliente = $producto->solicitud->peso+$diferencia_cliente;
		                        ?>
			                @endforeach
			                		<tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
	                        <tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
	                        <tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
	                        <tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
	                        <tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
	                        <tr>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                            <td class="tabla-productos" style="color: white;">MIDAS</td>
	                        </tr>
			                <tr style="border:1 solid;">
	                            <th class="tabla-productos" colspan="3">TOTALES</th>
	                            <td class="tabla-productos">
	                                {{ $total_peso_bruto }}
	                            </td>
	                            <td class="tabla-productos">
	                                {{ $total_peso_interno }}
	                            </td>
	                            <td class="tabla-productos">
	                               {{ $total_peso_neto }}
	                            </td>
	                        </tr>
		            	</tbody>
		            </TABLE>
		            <br>
		            <TABLE style="width:100%; font-size: 12px;">
		                <TR>
		                    <TD style="width: 70%;">
		                    	DIFERENCIA CON PESAJE INFORMADO POR CLIENTE:
		                   </TD>
		                   <TD style="width: 10%;">
		            						{{$ticket->diferencia_peso_kg}} KG
		                    </TD>
		                    <TD style="width: 10%;">
		                    	Favor
		                    	@if($ticket->diferencia_peso == 1) 
		                    	[ X ]
		                    	@else 
		                    	[   ]
		                    	@endif
		                   </TD>
		                   <TD style="width: 10%;">
		            					Contra 
		            					@if($ticket->diferencia_peso == 2) 
		                    	[ X ]
		                    	@else 
		                    	[   ]
		                    	@endif
		                    </TD>
		                </TR>
		              </TABLE>
		            <TABLE style="width:100%; font-size: 12px;">
		                <TR>
		                	<TD>
		                    	TIPO CARGA
		                   </TD>
		                   @foreach($tipo_producto as $tipo)
		                   <TD>
		                   			{{$tipo->nombre}} @if($ticket->tipo_producto_id == $tipo->id) 
			                    	[ X ]
			                    	@else 
			                    	[   ]
			                    	@endif
		                   </TD>
		                   @endforeach
		                   @if($ticket->tipo_producto_id == null)
		                   <TD>
		                    	Otro [ X ]
		                   </TD>
		                   <TD>
		                    	{{$ticket->otro_estado}}
		                   </TD>
		                   @else
		                   <TD>
		                    	Otro [   ]
		                   </TD>
		                   @endif
		                </TR>
		            </TABLE>
		            <TABLE style="width:100%; font-size: 12px;">
		                <TR>
		                	<TD colspan="2" style="width: 30%;">
		                    	OBSERVACIONES
		                   </TD>
		                    <TD  colspan="2" style="width: 70%;border: 1px solid black;">
		                    	{{$ticket->observaciones}}
		                   </TD>
		                </TR>
		            </TABLE>
		            <br>
		           <TABLE style="width:100%; font-size: 12px;">
		           			<TR>
		                    <TD style="width: 20%;">
		                    	
		                   </TD>
		                   <TD style="width: 35%;">
		            				
		                    </TD>
		                    <TD style="width: 20%;">
		                    	CONTROL CALIDAD
		                   </TD>
		                   <TD style="width: 25%;">
		                   </TD>
		                </TR>
		                <TR>
		                    <TD>
		                    	Descargado por
		                   </TD>
		                   <TD>
		            				: {{$ticket->descargado_por}}
		                    </TD>
		                    <TD>
		                    	Control Calidad 
		                   </TD>
		                   <TD>
		                   </TD>
		                </TR>
		                <TR>
		                	<TD>
		                    	Preparado por
		                   </TD>
		                   <TD>
		            				: {{$ticket->preparado_por}}
		                    </TD>
		                    <TD>
		                    	Autorizado por
		                   </TD>
		                   <TD>
		                   </TD>
		                </TR>
		                <TR>
		                	<TD>
		                    	Fecha de entrega
		                   </TD>
		                   <TD >
		            				: {{$ticket->fecha_entrega}}
		                    </TD>
		                    <TD >
		                    	Fecha Autorización
		                   </TD>
		                   <TD >
		                    </TD>
		                </TR>
		                <TR>
		                    <TD >
		                    	Firma
		                   </TD>
		                   <TD >
		                    </TD>
		                    <TD >
		                    	Firma
		                   </TD>
		                   <TD>
		                    </TD>
		                </TR>
		            </TABLE>
		        </div>
		      </div>
		    </div>

    	</main>
  </body>
</html>

