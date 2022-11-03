<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Categoria <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        {!!Form::open(['route' => 'mantenedor-categoria.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Categoria
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
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
        </div>
        {!!Form::close()!!}
    </div>
</div>