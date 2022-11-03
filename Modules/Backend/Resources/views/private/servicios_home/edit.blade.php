<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$servicio->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-servicios.update',$servicio->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Servicios
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$servicio->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..."])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Icono</label>
                            {!!Form::text('icono',$servicio->icono,['class'=>"form-control", 'placeholder'=>"Ingrese un icono..."])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Texto</label>
                            {!!Form::text('texto',$servicio->texto,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..."])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Peso</label>
                            {!!Form::number('peso',$servicio->peso,[ 'class'=>"form-control", 'min'=>"1",'max'=>"99" ,'placeholder'=>"Ingrese un peso..."])!!}
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
