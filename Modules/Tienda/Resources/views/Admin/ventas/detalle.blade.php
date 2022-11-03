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
                        @if($venta->ventas_fuera != null)
                        {{ $venta->ventas_fuera->nombre }}
                        @else
                            @if($venta->users_id != null)
                                {{ $venta->user->name }}
                            @else
                                Sin Registro
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Correo</label>
                    </div>
                    <div class="col-6">
                        @if($venta->ventas_fuera != null)
                            {{ $venta->ventas_fuera->correo }}
                        @else
                            @if($venta->users_id != null)
                                {{ $venta->user->email }}
                            @else
                                Sin Registrar
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Rut</label>
                    </div>
                    <div class="col-6">
                        @if($venta->ventas_fuera != null)
                            Venta Corta
                        @else
                            @if($venta->users_id != null)
                                {{ $venta->user->rut }}-{{ $venta->user->dv }}
                            @else
                                Sin Registrar
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Teléfono</label>
                    </div>
                    <div class="col-6">
                        @if($venta->ventas_fuera != null)
                        {{ $venta->ventas_fuera->telefono }}
                        @else
                            @if($venta->users_id != null)
                                {{ $venta->user->telefono }}
                            @else
                                Sin Registro
                            @endif
                        @endif
                    </div>
                    <div class="col-6">
                        <label>Fecha</label>
                    </div>
                    <div class="col-6">
                        {{ $venta->created_at->format('Y/m/d H:i')}}
                    </div>
                    <div class="col-6">
                        <label>Direccion de Despacho</label>
                    </div>
                    <div class="col-6">
                        @if($venta->ventas_fuera != null)
                            {{$venta->ventas_fuera->direccion }}
                             @if($venta->ventas_fuera->bk_comunas_id != null)
                                ,{{$venta->ventas_fuera->comuna->nombre}} 
                            @endif 
                            @if($venta->ventas_fuera->bk_regiones_id != null)
                            , {{$venta->ventas_fuera->region->nombre}} 
                            @endif
                        @else
                            @if($venta->bk_direcciones_user_id != null)
                                @if ($venta->direccion->bk_comunas_id != null )
                                    {{$venta->direccion->comuna->nombre}},
                                    @if ($venta->direccion->bk_regiones_id != null )
                                    {{$venta->direccion->region->nombre}},
                                    @endif
                                @endif
                                {{ $venta->direccion->nombre }}
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
                <h5>Datos de la boleta</h5>
                <div class="form-group row">
                    <div class="col-6">
                        <label>N° Venta</label>
                    </div>
                    <div class="col-6">
                        #{{$venta->id}}
                    </div>
                    <div class="col-6">
                        <label>Código Visualización</label>
                    </div>
                    <div class="col-6">
                        {{$venta->codigo}}
                    </div>
                </div>
                @if($venta->td_productos_id != null)
                    <h5>Productos</h5>
                    <div class="row">
                        <div class="col-3"><label>Nombre</label></div>
                        <div class="col-3">Precio</div>
                        <div class="col-3">Cantidad</div>
                        <div class="col-3">Total</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            {{$venta->producto->nombre}}
                        </div>
                        <div class="col-3">
                          ${{number_format($venta->producto->precio, 0, ',', '.')}}
                        </div>
                        <div class="col-3">
                            {{$venta->cantidad}}
                        </div>
                        <div class="col-3">
                            ${{number_format($venta->producto->precio*$venta->cantidad, 0, ',', '.')}}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-9">
                        <label>Monto Final</label>
                    </div>
                    <div class="col-3">
                       ${{number_format(($venta->producto->precio*$venta->cantidad)+$despacho, 0, ',', '.')}}
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
