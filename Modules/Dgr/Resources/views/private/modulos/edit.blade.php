<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditRol_{{$modul->id}}"><i class="fas fa-edit"></i></a>

<div id="EditRol_{{$modul->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar modulo {{$modul->name}}</h2>
        </header>
            {!!Form::open(['route' => ['modulos.update',$modul->id], 'method' => 'PUT'])!!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!!Form::text('nombre',$modul->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>

                    <div class="form-group">
                        <label for="">Descripción</label>
                        {!!Form::textarea('descripcion',$modul->descripcion,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'rows'=>'2'])!!}
                    </div>

                    <div class="form-group">
                        <label for="">Activo</label>
                        @if ($modul->estado == 1)
                            {!!Form::checkbox('estado', '1', true);!!}
                        @else
                            {!!Form::checkbox('estado', '1', false);!!}
                        @endif
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Cancel</button>

                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </footer>
            {!!Form::close()!!}
    </section>
</div>
