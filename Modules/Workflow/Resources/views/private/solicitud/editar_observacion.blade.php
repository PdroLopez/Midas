
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$soli->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(array('url' => 'workflow/editar-obs','method'=>"post")) }}


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Observacion
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            {!!Form::textarea('observaciones',$soli->observaciones,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'rows'=>'2'])!!}
                        </div>
                        <input type="hidden" name="id" value="{{$soli->id}}">
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
            {{-- {!!Form::close()!!} --}}
        </div>
    </div>
</div>
