<div class="modal fade" id="retiro{{ $boleta->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{ asset('workflow/post-retirado/') }}/{{ $boleta->id }}" files="true" enctype="multipart/form-data">
        @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Foto de articulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label>Imagenes</label>
                <input type="file" name="foto" id="foto" {{-- class="SubirFoto"  --}}accept="image/*" capture="camera"/>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                {!!Form::textarea('observacion_retirado',null,['class'=>"form-control", 'placeholder'=>'Escribir alguna observación','rows'=>'2'])!!}
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
    </form>
</div>