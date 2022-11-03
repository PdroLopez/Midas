<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#noticiasEstandar">
  Nuevo
</button>
<div class="modal fade" id="noticiasEstandar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!Form::open(['route' => 'mantenedor-categorias.store', 'method' => 'POST','files'=>true])!!}
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Categorias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control">
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

            {!! Form::close() !!}
        </div>
    </div>



</div>





