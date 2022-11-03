<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Recurso <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ asset('agendamiento/agregar') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Nuevo Recurso
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                {!!Form::text('descripcion',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Valor</label>
                                {!!Form::number('valor',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
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
        </form>
    </div>
</div>
