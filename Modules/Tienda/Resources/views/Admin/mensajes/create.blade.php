<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Mensaje <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        {!!Form::open(['route' => 'mantenedor-mensajes.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Mensaje
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Correo</label>
                            {!!Form::email('correo',null,['class'=>"form-control", 'placeholder'=>"Ingrese un correo..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Asunto</label>
                            {!!Form::text('asunto',null,['class'=>"form-control", 'placeholder'=>"Ingrese un asunto..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Mensaje</label>
                            <textarea class="form-control" name="mensaje" ></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Registrar
                </button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>