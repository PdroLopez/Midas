<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Residuos <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-combo-residuos.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Residuo
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="combos_id" value="{{$combo->id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Residuos</label>
                            {!!Form::select('Residuos_id',$residuos,null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required'])!!}
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
