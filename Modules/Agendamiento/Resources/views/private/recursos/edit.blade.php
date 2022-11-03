<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$res->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ asset('agendamiento/editar') }}/{{ $res->id }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Editar Recurso
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                {!!Form::text('nombre',$res->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                {!!Form::text('descripcion',$res->descripcion,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Valor</label>
                                {!!Form::number('valor',$res->valor,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
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
            </form>
        </div>
    </div>
</div>
