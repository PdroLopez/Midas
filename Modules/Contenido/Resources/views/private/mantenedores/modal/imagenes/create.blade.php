<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form files="true">
        <div class="modal-body">
            @csrf
            <div class="form-group">
               <label>Nombre o URL</label>
               <input type="text" name="nombre" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Archivo</label>
               <input type="file" name="archivo" class="form-control"> 
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>