<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$programaciones->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-programacion.update',$programaciones->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Programacion
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$programaciones->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
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

