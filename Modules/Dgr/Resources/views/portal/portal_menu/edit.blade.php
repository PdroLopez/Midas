<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditRol_{{$menu->id}}"><i class="fas fa-edit"></i></a>

<div id="EditRol_{{$menu->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar rol {{$menu->name}}</h2>
        </header>
            {!!Form::open(['route' => ['menu.update',$menu->id], 'method' => 'PUT'])!!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!! Form::text('nombre',$menu->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'required'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        {!! Form::text('url',$menu->url,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'required'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Peso</label>
                        {!! Form::number('peso',$menu->peso,['class'=>"form-control", 'placeholder'=>"Ingrese peso...",'required'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Sub-Menu</label>
                        <p>
                            @if($menu->sub_menu==1)
                            {!!Form::checkbox('sub_menu', '1', true);!!}
                            @else
                            {!!Form::checkbox('sub_menu', '1', false);!!}
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Estado</label>
                        <p>
                            @if($menu->estado==1)
                            {!!Form::checkbox('estado', '1', true);!!}
                            @else
                            {!!Form::checkbox('estado', '1', false);!!}
                            @endif
                            
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Pagina</label>
                        {!! Form::select('portal_pagina_id',$portal_pagina,$menu->portal_pagina_id,['class'=>"form-control", 'placeholder'=>"Seleccione..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Menu padre</label>
                        {!! Form::select('portal_menu_id',$portal_menu_padres,$menu->portal_menu_id,['class'=>"form-control", 'placeholder'=>"Seleccione..."])!!}
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
