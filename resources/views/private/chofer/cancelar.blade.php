<div class="modal fade" id="cancelar{{ $retiro->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <form action="{{ asset('workflow/comentario-cancelar') }}" method="post">
        @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancelar Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
              <div class="form-group">
                <label>¿Por qué cancela el retiro?</label>
            </div>
                <div class="form-group">
                    <label>Asunto</label>
                    {!!Form::select('asunto_cancelar',['Rechazo'=>'Rechazo','Cliente no se encontraba'=>'Cliente no se encontraba'],null,['class'=>"form-control", 'placeholder'=>"Seleccione"])!!}
                </div>
                <div class="form-group">
                    <label>Motivo</label>
                    {!!Form::textarea('comentario_cancelar',null,['class'=>"form-control", 'placeholder'=>"Escriba el motivo",'rows'=>'2'])!!}
                </div>
                {{ Form::hidden('id', $retiro->id) }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Cancelar</button>
      </div>
    </div>
  </div>
    </form>
</div>