<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$mensajes->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-mensajes.update',$mensajes->id],'files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Mensaje
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$mensajes->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." ])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Correo</label>
                            {!!Form::email('correo',$mensajes->correo,['class'=>"form-control", 'placeholder'=>"Ingrese un correo..." ])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Asunto</label>
                            {!!Form::text('asunto',$mensajes->asunto,['class'=>"form-control", 'placeholder'=>"Ingrese un asunto..." ])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Mensaje</label>
                            <textarea class="form-control" name="mensaje" >{{$mensajes->mensaje}}</textarea>
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
