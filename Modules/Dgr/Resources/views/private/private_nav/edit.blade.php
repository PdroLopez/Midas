<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditNav_{{$nav->id}}"><i class="fas fa-edit"></i></a>

<div id="EditNav_{{$nav->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar nav {{$nav->nombre}}</h2>
        </header>
            {!!Form::open(['route' => ['nav.update',$nav->id], 'method' => 'PUT'])!!}
                <div class="card-body">
                    <div class="form-group">
                    <label for="">Nombre</label>
                        {!!Form::text('nombre',$nav->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        {!!Form::text('url',$nav->url,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Peso</label>
                        {!!Form::number('peso',$nav->peso,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Activo</label>
                        @if ($nav->estado == 1)
                            <p>{!!Form::checkbox('estado', '1', true);!!}</p>
                        @else
                            <p>{!!Form::checkbox('estado', '1', false);!!}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Sub_nav <small>(nav hijo)</small></label>
                        @if ($nav->sub_nav == 1)
                            <p>{!!Form::checkbox('sub_nav', '1', true);!!}</p>
                        @else
                            <p>{!!Form::checkbox('sub_nav', '1', false);!!}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Nav padre</label>
                        {!!Form::select('private_nav_id',$nav_padre,$nav->private_nav_id,['class'=>"form-control", 'placeholder'=>"Seleccione"])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Icono</label>
                        {!!Form::text('icono',$nav->icono,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
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
