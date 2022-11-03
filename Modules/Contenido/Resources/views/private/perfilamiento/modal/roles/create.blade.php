<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
         {!!Form::open(['route' => 'mantenedor-roles.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
                @csrf
                    <div class="form-group">
                        <label>Nombre *</label>
                        <input type="text" name="name" placeholder="ej: superadmin" class="form-control">
                    </div>
                    <button class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         
        </div>
        {!!Form::close()!!}
     </div>
  </div>
</div>