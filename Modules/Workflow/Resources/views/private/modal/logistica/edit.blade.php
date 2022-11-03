<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="edit{{$boleta->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Boleta Solicitud Retiro
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                @if($boleta->users_id != null)
                    <h5>Usuario comprador</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nombre</label>
                        </div> 
                        <div class="col-6">
                            @if($boleta->user != null)
                            {{ $boleta->user->name }}
                            @endif
                        </div>
                        <div class="col-6">
                            <label>Correo</label>
                        </div> 
                        <div class="col-6">
                            @if($boleta->user != null)
                            {{ $boleta->user->email }}
                            @endif
                        </div>
                        <div class="col-6">
                            <label>Rut</label>
                        </div> 
                        <div class="col-6">
                            @if($boleta->user != null)
                                @if($boleta->user->rut != null)
                                {{ $boleta->user->rut }}-{{ $boleta->user->dv }}
                                @endif
                            @endif
                        </div>
                    </div>
                    <h5>Datos de la solicitud</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Código</label>
                        </div>
                        <div class="col-6">
                            #{{ $boleta->codigo }}
                        </div>
                    </div>
                    
                    <h5>Tiempo para el retiro</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>En:</label>
                        </div>
                        <div class="col-3">
                            @if ($boleta->horario_id != null)
                                @if($boleta->horario->hora != null)
                                {{ $boleta->horario->hora }}Hrs
                                @endif
                            @endif
                        </div>
                        <div class="col-3">
                            @if ($boleta->horario_id != null)
                                ${{ number_format($boleta->horario->precio) }}
                            @endif
                        </div>
                    </div>
                    
                    {{-- @if(count($boleta->solicitudes)>0)

                    <h5>Productos a retirar</h5>
                    <div class="row">
                        <div class="col-3"><label>Nombre</label></div>
                        <div class="col-3">Precio</div>
                        <div class="col-3">Cantidad</div>
                        <div class="col-3">Total</div>
                    </div>
                    @endif --}}
                    <div class="form-group row">
                        {{--@if(count($boleta->solicitudes)>0)
                            @foreach($boleta->solicitudes as $productos)
                                 <?php 
                                    $numero = (string)$productos->solicitud->residuos->precio*$productos->solicitud->cantidad;
                                    $puntos = floor((strlen($numero)-1)/3);
                                    $tmp = "";
                                    $pos = 1;
                                    for($i=strlen($numero)-1; $i>=0; $i--){
                                        $tmp = $tmp.substr($numero, $i, 1);
                                        if($pos%3==0 && $pos!=strlen($numero))
                                        $tmp = $tmp.".";
                                        $pos = $pos + 1;
                                    }
                                    $aqui_vamos = "$ ".strrev($tmp);
                                ?> 
                                <div class="col-3">
                                    {{ $productos->solicitud->residuos->nombre }}   
                                </div>
                                <div class="col-3">
                                    $ {{ number_format($productos->solicitud->residuos->precio) }}   
                                </div>
                                <div class="col-3">
                                    {{ $productos->solicitud->cantidad }}   
                                </div>
                                <div class="col-3">
                                    {!! $aqui_vamos !!}
                                </div>
                            @endforeach
                        @endif--}}

                    </div>
                    @if($boleta->empresas_id == null)
                    <h5>Particular</h5>
                    <div class="form-group row">
                        <div class="col-9">
                            Precio particular
                        </div>
                        <div class="col-3">
                            $20.000
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-9">
                            <label>Total</label>
                        </div>
                        <div class="col-3">
                            {!! $otraOnda !!}
                        </div>
                    </div>
                @else
                    <h5>Usuario Solicitante</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nombre</label>
                        </div> 
                        {{-- <div class="col-6">
                            @if($boleta->empresas_id == null)
                            {{ $boleta->empresas->emp_usuario->first()->user->name }}
                            @endif
                        </div> --}}
                        <div class="col-6">
                            <label>Correo</label>
                        </div> 
                        {{-- <div class="col-6">
                            @if($boleta->empresas_id == null)
                            {{ $boleta->empresas->emp_usuario->first()->user->email }}
                            @endif
                        </div> --}}
                    </div>
                    <h5>Empresa</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nombre</label>
                        </div> 
                        <div class="col-6">
                            @if($boleta->empresas_id != null)
                            {{ $boleta->empresas->nombre }}
                            @endif
                        </div>
                        <div class="col-6">
                            <label>Razon Social</label>
                        </div> 
                        <div class="col-6">
                            @if($boleta->empresas_id != null)
                            {{ $boleta->empresas->razon_social }}
                            @endif
                        </div>
                    </div>
                    <h5>Datos de la solicitud</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Código</label>
                        </div>
                        <div class="col-6">
                            #{{ $boleta->codigo }}
                        </div>
                    </div>
                    
                    <h5>Tiempo para el retiro</h5>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>En:</label>
                        </div>
                        {{-- //TODO el horario puede no existir. --}}
                        {{-- <div class="col-6">
                            @if($boleta->empresas_id == null)
                            {{ $boleta->horario->hora }}Hrs
                            @endif
                        </div> --}}
                    </div>
                    @if(count($boleta->solicitudes)>0)

                        <h5>Productos a retirar</h5>
                        <div class="row">
                            <div class="col-6"><label>Grupo</label></div>
                            <div class="col-6"><label>Categoria</label></div>
                        </div>
                    @endif
                    <div class="form-group row">
                        @if(count($boleta->solicitudes)>0)
                            @foreach($boleta->solicitudes as $productos)
                                <div class="col-6">
                                    {{ $productos->solicitud->grupo->nombre }}   
                                </div>
                                <div class="col-6">
                                    {{ $productos->solicitud->clasificacion->nombre }}   
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
