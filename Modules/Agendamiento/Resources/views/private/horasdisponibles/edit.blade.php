<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$h->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<form method="post" action="{{ asset('agendamiento/editar-hora') }}/{{ $h->id }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Editar Hora
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Día</label>
                                    {!!Form::text('dia',$h->dia,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tipo Hora</label>
                                    {!!Form::number('tipohora',$h->tipohora,['class'=>"form-control", 'placeholder'=>"" , 'required'])!!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hora_in">Hora Ingreso</label>
                                    <input class="form-control" type="time" value="{{ $h->hora_in }}" id="hora_in" name="hora_in">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hora_out">Hora Salida</label>
                                    <input class="form-control" type="time" value="{{ $h->hora_out }}" id="hora_out" name="hora_out">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Valor</label>
                                    {!!Form::number('valor',$h->valor,['class'=>"form-control", 'placeholder'=>"" , 'required'])!!}
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
