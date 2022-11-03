<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="estatus{{$venta->id}}" role="dialog" tabindex="-1">
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
                @if ($venta->tran_venta->count()!=0)
        			{!! Form::open(['route' => ['cambiar-estatus-transaccion',$venta->tran_venta->first()->transaccion->id],'files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'GET']) !!}
                    <input type="hidden" name="venta_id" value="{{$venta->id}}">
                    @if ($venta->tran_venta->first()->transaccion->bk_estatus_id != null  )
                        <div class="form-group">
                            <label for="">Estatus</label>
                            {!!Form::select('bk_estatus_id',$estatus,$venta->tran_venta->first()->transaccion->bk_estatus_id,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    @else
                        <div class="form-group">
                            <label for="">Estatus</label>
                            {!!Form::select('bk_estatus_id',$estatus,null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    @endif
                @else
                    {!! Form::open(['route' => ['cambiar-estatus',$venta->id],'files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'GET']) !!}
                        <div class="form-group">
                            <label for="">Estatus</label>
                            {!!Form::select('bk_estatus_id',$estatus,$venta->bk_estatus_id,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                @endif
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