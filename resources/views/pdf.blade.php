@extends('layouts.pdf')

@section('content')
<style>
    ul {
        margin-left: -10px;
        box-sizing: border-box;
       }

       li {
          float:left;
       margin-left: 10px;

       }
</style>
<center>
    @foreach ($boleta as  $v)
        <div class="container">
            <div class="row">
            <div class="col-12">
                <p style="text-align: center; ">
                    <img src="{{ asset('img/midas1.png') }}" style="width: 300px;"/>
                </p>
            </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <div class="col-12" align="center">
                    <h3><b>Nº 3809 / 2020 </b></h3>

                    <p align="justify">
                        <b>Empresa MIDAS </b>, Rut 76.008.262-7, domiciliada en avenida Juan de la Fuente 834, Lampa – Santiago,
                        facultada por el Seremi de Salud R.M. para el reciclaje y disposición final de residuos mediante las siguientes
                        resoluciones:
                    </p>
                    <ul>
                        <li>Reciclaje de residuos industriales: Nº003068/2009, Nº64666/2012</li>  <br>
                        <li>Reciclaje de residuos electrónicos: Nº 83749/2011 y Nº41096/2013</li>  <br>
                        <li>Transporte de residuos peligrosos y no peligrosos: Nº1416/2010, Nº 38748/2011 y Nº15662/2013</li>  <br>
                    </ul>
                    <div class="col-12" align="left">
                        <p style="left:-20px;">
                            Certifica que ha recibido residuos provenientes de:
                        </p>

                        <TABLE width="70%;">
                            <TR>
                                <TD> Empresa</TD>
                                <TD>:

                                   @if ($v->empresas_id != null )

									    {{$v->empresas->nombre}}
									@else
										Sin Empresa

									@endif
                                
                                </TD>
                            </TR>
                            <TR>
                                <TD>Rut </TD>
                                <TD>:   @if ($v->empresas_id != null )

									        {{$v->empresas->rut}}
									    @else
										    Sin Empresa

									    @endif</TD>
                            </TR>
                            <TR>
                                <TD>Dirección</TD>
                                <TD>: 

                                 @if ($v->bk_direcciones_empresas_id != null )
                                    @if ($v->direccion_empresa != null)
                                      {{$v->direccion_empresa->nombre}}, {{$v->direccion_empresa->comuna->nombre}}, {{{$v->direccion_empresa->region->nombre}}}
                                    @else
                                        sin nombre   
                                    @endif
									
								@else
									Sin Fecha

								@endif
                                
                                
                                </TD>
                            </TR>
                            <TR>
                                <TD>Guías de Despacho</TD>
                                <TD>: 412104-412105</TD>
                            </TR>
                            <TR>
                                <TD>Fecha de retiro</TD>
                                <TD>: 
                                        @if ($v->fecha_hora != null )

											{{$v->fecha_hora}}
										@else
											Sin Fecha

										@endif
                                
                                
                                </TD>
                            </TR>
                            <TR>
                                <TD> Nº Pesaje</TD>
                                <TD>: 26091-26131</TD>
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
                            Los residuos antes mencionados, fueron procesados de forma sustentable con procesos que priorizan la
                            recuperación y reciclaje en Chile, cumpliendo los estándares de la legislación ambiental vigente y
                            garantizando la protección de su marca.
                        </p>
                        <br>
                        <br>
                    

                    </div>



                        <TABLE width="100%;">
                            <TR>
                                <TD>
                                    Mitzy Lagos M.
                                    <br>
                                    Ingeniero Ambiental </TD>
                                <TD>
                                    <p align="right"> Daniel Saldias M.
                                        <br>
                                        Director De Economia Circular</p>

                                </TD>
                            </TR>

                        </TABLE>

                        <div class="col-12" align="center">
                            <br><br>
                            Santiago, 27 de Julio del 2020
                        </div>
            




            </div>
            
            {{--  <div class="col-12" align="center" >
                <p align="justify ">
                <b>Empresa MIDAS </b>, Rut 76.008.262-7, domiciliada en avenida Juan de la Fuente 834, Lampa – Santiago,<br>
                facultada por el Seremi de Salud R.M. para el reciclaje y disposición final de residuos mediante las siguientes<br>
                resoluciones:
                </p>
            </div>
            <div class="col-12" align="center">
                <ul>
                    <li>Reciclaje de residuos industriales: Nº003068/2009, Nº64666/2012</li>  <br>
                    <li>Reciclaje de residuos electrónicos: Nº 83749/2011 y Nº41096/2013</li>  <br>
                    <li>Transporte de residuos peligrosos y no peligrosos: Nº1416/2010, Nº 38748/2011 y Nº15662/2013</li>  <br>
                </ul>


            </div>
            <div class="col-12" align="left">
                <p style="left:-20px;">
                    Certifica que ha recibido residuos provenientes de:
                </p>

                <TABLE width="70%;">
                    <TR>
                        <TD> Empresa</TD>
                        <TD>: ACHS</TD>
                    </TR>
                    <TR>
                        <TD>Rut </TD>
                        <TD>: 70.365.100-6</TD>
                    </TR>
                    <TR>
                        <TD>Dirección</TD>
                        <TD>: Ramón Carnicer 163, Providencia</TD>
                    </TR>
                    <TR>
                        <TD>Guías de Despacho</TD>
                        <TD>: 412104-412105</TD>
                    </TR>
                    <TR>
                        <TD>Fecha de retiro</TD>
                        <TD>: 21 y 24 de Julio del 2020</TD>
                    </TR>
                    <TR>
                        <TD> Nº Pesaje</TD>
                        <TD>: 26091-26131</TD>
                    </TR>
                    <TR>
                        <TD>Cantidad</TD>
                        <TD>: 1.976 kilos </TD>
                    </TR>
                </TABLE>

                <br>

                <p>
                    Los residuos antes mencionados, fueron procesados de forma sustentable con procesos que priorizan la <br>
                    recuperación y reciclaje en Chile, cumpliendo los estándares de la legislación ambiental vigente y<br>
                    garantizando la protección de su marca.
                </p>
                <br>
                <br>
                <br>
                <br>


                    <TABLE width="100%;">
                        <TR>
                            <TD>
                                Mitzy Lagos M.
                                <br>
                                Ingeniero Ambiental </TD>
                            <TD>
                                <p align="right"> Daniel Saldias M.
                                    <br>
                                    Director De Economia Circular</p>

                            </TD>
                        </TR>

                    </TABLE>



            </div> --}}

            
            

            </div>
        </div>
        
        </div>
        
    @endforeach
   

</center>

@endsection

