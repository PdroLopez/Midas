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
        height: 5cm;
    }
  </style>
  <head >
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado {{-- {{$boleta->codigo}} --}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body >
     <header>
           <img src="{{ asset('arribacertificado.png') }}" style="width: 100%;height:100%;"/>

        </header>

        <footer>
            <img src="{{ asset('abajocertificado.png') }}" style="width: 100%;height:100%;"/>
        </footer>
        <main>
    <div class="container" style="margin-top: 11%;">
      <div class="row">
        <div class="col-12" align="center">
              <h5 style="text-transform:uppercase; color: #5b96d3;font-family: 'Trebuchet MS', Verdana, Arial, Helvetica, sans-serif;"><b>CERTIFICADO DE DESTRUCCIÓN Y RECICLAJE</b></h5><br>
              <h6 style="background-color: #5b96d3;border-radius: 20%;color: white;margin: 0px 40% 0px 40%;"><b>Nº 3809 / 2020</b></h6>
        </div>
      </div>
    </div>
    <br>
    <div class="container" >
      <div class="row" style="margin-right: 17%;margin-left: 6%;">
        <div class="col-12" align="center">
            <font size="1" style="font-family: 'Trebuchet MS', Verdana, Arial, Helvetica, sans-serif;">
            <p align="justify">
                <b>Empresa MIDAS </b>, Rut 76.008.262-7, domiciliada en avenida Juan de la Fuente 834, Lampa – Santiago, facultada por el Seremi de Salud R.M. para el reciclaje y disposición final de residuos mediante las siguientes resoluciones:
            </p>
            <ul>
                <li>Reciclaje de residuos industriales: Nº003068/2009, Nº64666/2012</li>  <br>
                <li>Reciclaje de residuos electrónicos: Nº 83749/2011 y Nº41096/2013</li>  <br>
                <li>Transporte de residuos peligrosos y no peligrosos: Nº1416/2010, Nº 38748/2011 y Nº15662/2013</li>  <br>
            </ul>
            <div class="col-12" >
                <p style="left:-20px;">
                    Certifica que ha recibido residuos provenientes de:
                </p>
                <TABLE width="">
                <TR>
                    <TD>Solicitante</TD>
                    <TD>:
                       {{--  @if($boleta->empresas_id != null)
                            {{ $boleta->empresas->nombre }}
                        @else
                            @if($boleta->users_id != null)
                                {{ $boleta->user->name }} {{ $boleta->user->apellido }}
                            @else
                                {{$boleta->nombre}}
                            @endif
                        @endif --}}
                    </TD>
                </TR>
                <TR>
                    <TD>Dirección</TD>
                    <TD>:{{-- @if($boleta->bk_direcciones_empresas_id != null)
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
                    @endif --}}
                    </TD>
                </TR>
                <TR>
                    <TD>Fecha de retiro</TD>
                    <TD>: 
                       {{--  @if ($boleta->fecha_hora != null)
                          Fecha: {{$boleta->fecha_hora}}.<br>
                        @else
                           Sin Programar.<br>
                        @endif --}}
                    </TD>
                </TR>
                <TR>
                    <TD>Cantidad</TD>
                    <TD>: 1.976 kilos </TD>
                </TR>
                    </TABLE>
                    <br>
                    </div>
                    <div class="col-12" align="left" style="text-align=justify;">
                        <p>
                            Los residuos antes mencionados, fueron procesados de forma sustentable con procesos que priorizan la recuperación y reciclaje en Chile, cumpliendo los estándares de la legislación ambiental vigente y garantizando la protección de su marca.
                        </p>
                        <br>
                    </div>
                    <TABLE width="100%;">
                        <TR>
                            <TD>
                                Mitzy Lagos M.<br>
                                Ingeniero Ambiental </TD>
                            <TD>
                                <p align="right"> Daniel Saldias M.<br>
                                Director De Economia Circular</p>
                            </TD>
                        </TR>

                    </TABLE>
                    <div class="col-12" align="center">
                        <br><br>
                        Santiago, 12 de Enero del 2021
                    </div>
                </font>
        </div>
      </div>
    </div>
  </body>
</html>

