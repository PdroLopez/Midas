<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$camion->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-camiones.update',$camion->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Camión
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$camion->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Patente</label>
                            {!!Form::text('patente',$camion->patente,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tipo</label>
                            {!!Form::select('tipo_camion_id',$tipo_camion,$camion->tipo_camion_id,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Camionero</label>
                            {!!Form::select('users_id',$user,$camion->users_id,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
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
