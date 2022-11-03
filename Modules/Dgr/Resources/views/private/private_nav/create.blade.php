<a class="modal-with-form btn btn-default" href="#CreateNav">Nuevo nav</a>

<div id="CreateNav" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de nav</h2>
        </header>
        {!!Form::open(['route' => 'nav.store', 'method' => 'POST'])!!}
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre</label>
                    {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>
                <div class="form-group">
                    <label for="">Url</label>
                    {!!Form::text('url',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>
                <div class="form-group">
                    <label for="">Peso</label>
                    {!!Form::number('peso',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>
                <div class="form-group">
                    <label for="">Activo</label>
                    <p>
                        {!!Form::checkbox('estado', '1', true);!!}
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Sub_nav <small>(nav hijo)</small></label>
                    <p>
                        {!!Form::checkbox('sub_nav', '1', false);!!}
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Nav padre</label>
                    {!!Form::select('private_nav_id',$nav_padre,null,['class'=>"form-control", 'placeholder'=>"Seleccione"])!!}
                </div>
                <div class="form-group">
                    <label for="">Icono</label>
                    {!!Form::text('icono',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto"])!!}
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