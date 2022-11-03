<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Hora <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ asset('agendamiento/agregar-hora') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Nueva Hora
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Día</label>
                                {!!Form::text('dia',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tipo Hora</label>
                                {!!Form::number('tipohora',null,['class'=>"form-control", 'placeholder'=>"" , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora_in">Hora Ingreso</label>
                                <input class="form-control" type="time" value="" id="hora_in" name="hora_in">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora_out">Hora Salida</label>
                                <input class="form-control" type="time" value="" id="hora_out" name="hora_out">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Valor</label>
                                {!!Form::number('valor',null,['class'=>"form-control", 'placeholder'=>"" , 'required'])!!}
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
