<!DOCTYPE html>
<html>
  <style type="text/css">
      html {
      margin: 0;
    }

    /** Definir las reglas del encabezado **/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 4cm;

    }

    /** Definir las reglas del pie de página **/
    footer {
        position: fixed; 
        bottom: 0cm; 
        left: 0cm; 
        right: 0cm;
        height: 3.5cm;
    }
  </style>
  <head >
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado {{$boleta->codigo}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    |   <header>
           <img src="{{ asset('arribacertificado.png') }}" style="width: 100%;height:100%;"/>

        </header>

        <footer>
            <img src="{{ asset('abajocertificado1.png') }}" style="width: 100%;height:100%;"/>
        </footer>
        <main>
    <div class="container" style="margin-top: 11%;">
      <div class="row">
        <div class="col-12" align="center">
              <h6 style="text-transform:uppercase; color: #67c819;font-family: 'Trebuchet MS', Verdana, Arial, Helvetica, sans-serif;">CERTIFICADO DE DESTRUCCIÓN Y RECICLAJE</h6>
              <h6 style="background-color: #5b96d3;border-radius: 50%;color: white;margin: 0px 40% 0px 40%;"><b>Nº 3809 / 2021</b></h6>
        </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row" style="margin-right: 5%;margin-left: 7%;">
        <div class="col-12">
          
           <font size="2" style="font-family: 'Trebuchet MS', Verdana, Arial, Helvetica, sans-serif;">
            <p align="justify">
                <b>Empresa MIDAS</b>, Rut 76.008.262-7, domiciliada en avenida Juan de la Fuente 834, Lampa – Santiago, facultada por el Seremi de Salud R.M. para el reciclaje y disposición final de residuos mediante las siguientes resoluciones:
            </p>
            <p align="left">
            <ul >
                <li>Reciclaje de residuos industriales: Nº003068/2009, Nº64666/2012</li>  <br>
                <li>Reciclaje de residuos electrónicos: Nº 83749/2011 y Nº41096/2013</li>  <br>
                <li>Transporte de residuos peligrosos y no peligrosos: Nº1416/2010, Nº 38748/2011 y Nº15662/2013</li>  <br>
            </ul>
            </p>
            <div class="col-12" align="left">
                <p style="left:-20px;">
                    Certifica que ha recibido residuos provenientes de:
                </p>
                <TABLE style="width:100%">
                <TR>
                    <TD style="width: 200px;">Solicitante</TD>
                    <TD>:
                        @if($boleta->empresas_id != null)
                            {{ $boleta->empresas->nombre }}
                        @else
                            @if($boleta->users_id != null)
                                {{ $boleta->user->name }} {{ $boleta->user->apellido }}
                            @else
                                {{$boleta->nombre}}
                            @endif
                        @endif
                    </TD>
                </TR>
                <TR>
                    <TD>Rut</TD>
                    <TD>:
                        @if($boleta->empresas_id != null)
                            {{ $boleta->empresas->rut }}
                        @else
                            @if($boleta->users_id != null)
                                @if($boleta->user->rut != null)
                                    {{ $boleta->user->rut }}
                                @else
                                    No ingresado
                                @endif
                            @else
                                No ingresado
                            @endif
                        @endif
                    </TD>
                </TR>
                <TR>
                    <TD>Dirección</TD>
                    <TD>:@if($boleta->bk_direcciones_empresas_id != null)
                        @if($boleta->direccion != null)
                            {{ $boleta->direccion->nombre }}
                            @if ($boleta->direccion->bk_comunas_id != null)
                                {{ $boleta->direccion->comuna->nombre }}, 
                            @else
                                Sin Comuna, 
                            @endif
                            @if ($boleta->direccion->bk_regiones_id != null)
                                {{ $boleta->direccion->region->nombre}}.
                            @else
                                Sin Región.
                            @endif
                        @endif
                    @endif
                    @if($boleta->bk_direcciones_user_id != null)
                            @if ($boleta->direccion->nombre != null)
                                {{ $boleta->direccion->nombre }}
                            @else
                                Sin Calle<br>
                            @endif
                            @if ($boleta->direccion->bk_comunas_id != null)
                                {{ $boleta->direccion->comuna->nombre }}
                            @else
                             Sin Comuna, 
                            @endif
                            @if ($boleta->direccion->bk_regiones_id != null)
                                {{ $boleta->direccion->region->nombre }}. 
                            @else
                                Sin Región.
                            @endif
                    @else
                        {{ $boleta->direccion_rc }} {{ $boleta->detalle }}
                        @if ($boleta->comuna_id != null)
                            {{ $boleta->comuna->nombre }}, 
                        @else
                            Sin Comuna, 
                        @endif
                        Metropolitana de Santiago.
                    @endif
                    </TD>
                </TR>
                <TR>
                    <TD>Fecha</TD>
                    <TD>: 
                        {{ $boleta->updated_at->format('d') }} de 
                        @switch($boleta->updated_at->format('m'))
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
                         del {{ $boleta->updated_at->format('Y') }}
                    </TD>
                </TR>
                <TR>
                    <TD>Ticket de pesaje N°</TD>
                    <TD>: @if($boleta->ticket->count() != 0)
                            {{ $boleta->ticket->first()->id }}
                        @else
                            Sin Ticket
                        @endif
                    </TD>
                </TR>
                <TR>
                    <TD>Guía de Despacho N°</TD>
                    <TD>: 
                        @if($boleta->n_guia_despacho != null)
                            {{$boleta->n_guia_despacho}}
                        @else
                            No registrado.
                        @endif
                    </TD>
                </TR>
                <TR>
                    <TD>Residuos</TD>
                    <TD>:
                        @foreach ($boleta->solicitudes as $producto)
                            @if ($producto->solicitud->Residuos_id != null)
                                - {{ $producto->solicitud->residuos->nombre }}
                            @else
                                @if($producto->solicitud->grupos_id != null)
                                    - {{$producto->solicitud->grupo->nombre}}, {{$producto->solicitud->clasificacion->nombre}} 
                                @else
                                    - {{$producto->solicitud->nombre}}
                                @endif
                            @endif
                        @endforeach
                    </TD>
                </TR>
                <TR>
                    <TD>Cantidad</TD>
                    <TD>:<?php $peso_neto = 0; ?>
                        @foreach ($boleta->solicitudes as $element)
                            <?php $peso_neto = $peso_neto+$element->solicitud->peso_neto;?>
                        @endforeach
                        {{$peso_neto}} Kilos
                    </TD>
                </TR>
            </TABLE>
            <br>
            </div>
            <p align="justify">
                Los residuos antes mencionados, fueron reciclados mediante procesos que priorizan la recuperación de materias primas en Chile, cumpliendo los estándares de la legislación ambiental vigente y garantizando la protección de su marca.
            </p>
            <p align="justify">
                De esta forma, gracias a nuestra alianza, juntos hemos disminuido el impacto ambiental de su empresa, aportando a la sustentabilidd y el cuidado de nuestro Medioambiente.
            </p>
            <br>
            <br>
            <br>
            <TABLE style="width: 100%;">
                <TR>
                    <TD style="text-align: center;width: 30%;">
                        Mitzy Lagos M.<br>
                        Ingeniero Ambiental 
                    </TD>
                    <TD style="text-align: center;width: 20%;"> 
                        <img src="{{ asset('arbolcertificado.png') }}" style="width: 90px"/>
                    </TD>
                    <TD style="text-align: center;width: 30%;">    Daniel Saldias M.<br>
                        Director De Economia Circular
                    </TD>
                </TR>

            </TABLE>
            <div class="col-12" align="center">
                <br>
                Santiago, {{ $boleta->updated_at->format('d') }} de 
            @switch($boleta->updated_at->format('m'))
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
               del {{ $boleta->updated_at->format('Y') }}
            </div>
         </font>
        </div>
      </div>
    </div>
    </main>
  </body>
</html>

