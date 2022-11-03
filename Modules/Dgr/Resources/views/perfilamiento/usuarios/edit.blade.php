<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditUsuario_{{$usuario->id}}"><i class="fas fa-edit"></i></a>

<div id="EditUsuario_{{$usuario->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar Usuario {{$usuario->name}}</h2>
        </header>
            {!!Form::open(['route' => ['usuarios.update',$usuario->id], 'method' => 'PUT'])!!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!!Form::text('name',$usuario->name,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary">Actualizar</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            {!!Form::close()!!}
    </section>
</div>
