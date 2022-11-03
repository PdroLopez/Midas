<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditTipoInput_{{$imagen->id}}"><i class="fas fa-edit"></i></a>

<div id="EditTipoInput_{{$imagen->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar Imagen {{$imagen->nombre}}</h2>
        </header>
            {!!Form::open(['route' => ['img.update',$imagen->id], 'method' => 'PUT','files'=>true])!!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!!Form::text('nombre',$imagen->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto..." , 'required'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Archivo</label>
                        <p>
                            <img src="{{asset('storage/'.$imagen->src)}}" style="width: 100%">
                        </p>
                        <p>
                            {!!Form::file('archivo',null,['class'=>"form-control", 'required'])!!}
                        </p>
                       
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
