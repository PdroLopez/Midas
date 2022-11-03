<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Pagina</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         {!!Form::open(['route' => 'mantenedor-page.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
                @csrf
                    <div class="form-group">
               <label>Titulo</label>
               <input type="text" name="titulo" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Subtitulo</label>
               <input type="text" name="subtitulo" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Alias</label>
               <input type="text" name="alias" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Peso</label>
               <input type="number" name="peso" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Body</label>
               <textarea class="form-control" id="TextAB" rows="10" name="body" data-plugin-codemirror data-plugin-options="{ "mode": "text/html" }"></textarea>
            </div>
                    <button class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         
        </div>
        {!!Form::close()!!}
     </div>
  </div>
</div>