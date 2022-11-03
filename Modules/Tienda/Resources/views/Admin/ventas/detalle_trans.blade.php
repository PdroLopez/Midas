<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detalle{{$venta->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Boleta
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <h5>Usuario comprador</h5>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Nombre</label>
                    </div>
                    <div class="col-6">
                        @if($venta->tran_venta->first()->transaccion->user != null)
                        {{ $venta->tran_venta->first()->transaccion->user->name }}
                        @else
                            @if ($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                {{ $venta->tran_venta->first()->transaccion->ventas_fuera->nombre }}
                            @elseif($venta->tran_venta->first()->transaccion->boletas_id != null)
                                                {{$venta->tran_venta->first()->transaccion->boleta->nombre}}
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Correo</label>
                    </div>
                    <div class="col-6">
                       @if($venta->tran_venta->first()->transaccion->user != null)
                        {{ $venta->tran_venta->first()->transaccion->user->email }}
                        @else
                            @if ($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                {{ $venta->tran_venta->first()->transaccion->ventas_fuera->correo }}
                            @elseif($venta->tran_venta->first()->transaccion->boletas_id != null)
                                {{$venta->tran_venta->first()->transaccion->boleta->correo}}
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Rut</label>
                    </div>
                    <div class="col-6">
                        @if($venta->tran_venta->first()->transaccion->user != null)
                        {{ $venta->tran_venta->first()->transaccion->user->rut }}-{{ $venta->tran_venta->first()->transaccion->user->dv }}
                        @else
                        Sin Registro
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Teléfono</label>
                    </div>
                    <div class="col-6">
                        @if($venta->tran_venta->first()->transaccion->user != null)
                            {{ $venta->tran_venta->first()->transaccion->user->telefono}}
                        @else
                            @if ($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                {{ $venta->tran_venta->first()->transaccion->ventas_fuera->telefono }}
                            @elseif($venta->tran_venta->first()->transaccion->boletas_id != null)
                                {{$venta->tran_venta->first()->transaccion->boleta->telefono}}
                            @endif
                            
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Fecha</label>
                    </div>
                    <div class="col-6">
                        {{ $venta->tran_venta->first()->transaccion->created_at->format('d/m/Y H:i')}}
                    </div>
                    <div class="col-6">
                        <label>Dirección de Despacho</label>
                    </div>
                    <div class="col-6">
                        @if($venta->tran_venta->first()->transaccion->bk_direcciones_user_id != null)
                            @if ($venta->tran_venta->first()->transaccion->direccion->bk_comunas_id != null )
                                {{$venta->tran_venta->first()->transaccion->direccion->comuna->nombre}},
                                @if ($venta->tran_venta->first()->transaccion->direccion->bk_regiones_id != null )
                                {{$venta->tran_venta->first()->transaccion->direccion->region->nombre}},
                                @endif
                            @endif
                            {{$venta->tran_venta->first()->transaccion->direccion->nombre }}
                        @else
                            @if ($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                {{$venta->tran_venta->first()->transaccion->ventas_fuera->direccion }}
                                @if($venta->tran_venta->first()->transaccion->ventas_fuera->bk_comunas_id != null)
                                    ,{{$venta->tran_venta->first()->transaccion->ventas_fuera->comuna->nombre}} 
                                @endif 
                                @if($venta->tran_venta->first()->transaccion->ventas_fuera->bk_regiones_id != null)
                                , {{$venta->tran_venta->first()->transaccion->ventas_fuera->region->nombre}} 
                                @endif
                            @elseif($venta->tran_venta->first()->transaccion->boletas_id != null)
                                {{$venta->tran_venta->first()->transaccion->boleta->direccion_rc}}, {{$venta->tran_venta->first()->transaccion->boleta->comuna->nombre}}
                                
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Valor de Despacho</label>
                    </div>
                    <div class="col-6">
                        @if ($venta->bk_despacho_id != null)
                            @if($venta->despacho->bk_cobertura_id == 1)
                                ${{ $venta->despacho_valor}}</td>
                            @else 
                                Envio por pagar via Starken
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Tipo Venta</label>
                    </div>
                    <div class="col-6">
                        @if($venta->tipo_venta_id != null)
                            {{$venta->tipo_venta->nombre}}
                        @else
                            @if($venta->tran_venta->first()->transaccion->ventas_fuera_id != null)
                                <p>Redes Sociales</p>
                            @else
                                <p>Tienda</p>
                            @endif
                        @endif
                    </div>
                </div>
                <h5>Datos de Venta</h5>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Código</label>
                    </div>
                    <div class="col-6">
                        #{{$venta->tran_venta->first()->transaccion->codigo }}
                    </div>
                    <div class="col-6">
                        <label>ID Transacción</label>
                    </div>
                    <div class="col-6">
                        #{{$venta->tran_venta->first()->transacciones_id }}
                    </div>
{{--                     <div class="col-6">
                        <label>Código Venta</label>
                    </div>
                    <div class="col-6">
                        #{{$venta->codigo }}
                    </div> --}}
                </div>
                @if($venta->tran_venta->first()->transaccion->boletas_id != null)
                <h5>Datos Solicitud de Retiro</h5>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Código</label>
                    </div>
                    <div class="col-6">
                        #{{$venta->tran_venta->first()->transaccion->boleta->codigo }}
                    </div>
                    <div class="col-6">
                        <label>Monto Retiro</label>
                    </div>
                    <div class="col-6">
                        ${{$venta->tran_venta->first()->transaccion->boleta->total }}
                    </div>
                </div>
                @endif
                @if(count($venta->tran_venta->first()->transaccion->tran_venta)>0)
                <h5>Productos</h5>
                <div class="row">
                    <div class="col-2"><label>ID Venta</label></div>
                    <div class="col-3"><label>Nombre</label></div>
                    <div class="col-2">Precio</div>
                    <div class="col-3">Cantidad</div>
                    <div class="col-2">Total</div>
                </div>
                @endif
                <div class="form-group row">
                    @if(count($venta->tran_venta->first()->transaccion->tran_venta)>0)
                        @foreach($venta->tran_venta->first()->transaccion->tran_venta as $productos)
                        <?php
                            $numero = (string)$productos->venta->producto->precio*$productos->venta->cantidad;
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
                        <div class="col-2">
                            {{ $productos->ventas_id}}
                        </div>
                        <div class="col-3">
                            {{ $productos->venta->producto->nombre }}
                        </div>
                        <div class="col-2">
                            $ {{ number_format($productos->venta->producto->precio) }}
                        </div>
                        <div class="col-3">
                            {{ $productos->venta->cantidad }}
                        </div>
                        <div class="col-2">
                            {!! $aqui_vamos !!}
                        </div>
                        @endforeach
                    @endif

                </div>
                <div class="row">
                    <div class="col-9">
                        <label>Total</label>
                    </div>
                    <div class="col-3">
                        ${{number_format($venta->tran_venta->first()->transaccion->total, 0, ',', '.')}}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
