<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!!Form::open(['route' => 'mantenedor-slider.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
            @csrf
            <div class="form-group">
               <label>Imagen (Tamaño Recomendado 915x500)</label>
               <input type="file" name="archivo" class="form-control">
            </div>
            <div class="form-group">
               <label>Texto Principal</label>
               <input type="text" class="form-control" name="texto_principal" >
            </div>
            <div class="form-group">
               <label>Texto Secundario</label>
               <input type="text" class="form-control" name="texto_secundario" >
            </div>
            <div class="form-group">
               <label>Texto Botón</label>
               <input type="text" class="form-control" name="btn_texto" >
            </div>
            <div class="form-group">
               <label>Url Botón</label>
               <input type="text" class="form-control" name="btn_url" >
            </div>
            <div class="form-group">
                <label>Atributo</label>
                <input type="text" class="form-control" name="atributos" >
             </div>
             <div class="form-group">
                <label>Active</label>
                <input type="text" class="form-control" name="active" >
             </div>
            <div class="form-group">
               <label>Categoria</label>
               <select class="custom-select" name="ct_categoria_slider_id">
                  <option value="" selected >Seleccione</option>
                  @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
     {!!Form::close()!!}
    </div>
  </div>
</div>
