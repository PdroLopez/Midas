<a class="modal-with-form btn btn-default" href="#CreateMenu">Nuevo Menu</a>
<div id="CreateMenu" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de Menu</h2>
        </header>
            {!!Form::open(['route' => 'menu.store', 'method' => 'POST'])!!}
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre</label>
                    {!! Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'required'])!!}
                </div>
                <div class="form-group">
                    <label for="">Url</label>
                    {!! Form::text('url',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto...",'required'])!!}
                </div>
                <div class="form-group">
                    <label for="">Peso</label>
                    {!! Form::number('peso',null,['class'=>"form-control", 'placeholder'=>"Ingrese peso...",'required'])!!}
                </div>
                <div class="form-group">
                    <label for="">Sub-Menu</label>
                    <p>
                        {!!Form::checkbox('sub_menu', '1', false);!!}
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    <p>
                        {!!Form::checkbox('estado', '1', true);!!}
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Pagina</label>
                    {!! Form::select('portal_pagina_id',$portal_pagina,null,['class'=>"form-control", 'placeholder'=>"Seleccione..."])!!}
                </div>
                <div class="form-group">
                    <label for="">Menu padre</label>
                    {!! Form::select('portal_menu_id',$portal_menu_padres,null,['class'=>"form-control", 'placeholder'=>"Seleccione..."])!!}
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </footer>
        {!!Form::close()!!}
    </section>
</div>