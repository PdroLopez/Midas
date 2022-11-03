<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$despacho->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-despacho.update',$despacho->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Despacho
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Cobertura</label>
                            {!!Form::select('bk_cobertura_id',$coberturas,$despacho->bk_cobertura_id,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Costo</label>
                            {!!Form::text('costo',$despacho->costo,['class'=>"form-control", 'placeholder'=>"Ingrese un Costo",'required'])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
