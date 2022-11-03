<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Producto <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-residuos.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Producto
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
{{--                     <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div> --}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Altura (CM)</label>
                            {!!Form::number('altura',null,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Largo (CM)</label>
                            {!!Form::number('largo',null,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Ancho (CM)</label>
                            {!!Form::number('ancho',null,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" name="imagen[]" class="form-control" required>
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
