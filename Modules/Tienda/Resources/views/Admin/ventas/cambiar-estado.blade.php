<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="estado{{$venta->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Cambiar Estado
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
{{--                 @if ($venta->tran_venta->count()!=0)
        			{!! Form::open(['route' => ['cambiar-estado',$venta->tran_venta->first()->transaccion->id],'files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'GET']) !!}
                    <input type="hidden" name="op" value="0">
                    @if ($venta->tran_venta->first()->transaccion->estatus != null  )
                        <div class="form-group">
                            <label for="">Estado</label>
                            {!!Form::select('bk_estatus_id',$estatus,$venta->tran_venta->first()->transaccion->estatus->id,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    @else
                        <div class="form-group">
                            <label for="">Estado</label>
                            {!!Form::select('bk_estatus_id',$estatus,null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    @endif
                @else --}}
                    {!! Form::open(['route' => ['cambiar-estado',$venta->id],'files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'GET']) !!}
                        <input type="hidden" name="op" value="1">
                        <div class="form-group">
                            <label for="">Estado</label>
                            {!!Form::select('estado',['por pagar'=>'Por Pagar','pagado'=>'Pagado','no pagado'=>'No Pagado'],$venta->estado,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                {{-- @endif --}}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>