<a class="modal-with-form btn btn-default" href="#CreateTipoInput">Nueva Imagen</a>

<div id="CreateTipoInput" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de tipo input</h2>
        </header>
        {!!Form::open(['route' => 'img.store', 'method' => 'POST','files'=>true])!!}
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre</label>
                    {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..." , 'required'])!!}
                </div>
                <div class="form-group">
                    <label for="">Archivo</label>
                    <p>
                    {!!Form::file('archivo',null,['class'=>"form-control", 'required'])!!}
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Class</label>
                    <textarea rows="1" class="form-control" id="codemirror_html_code" name="class" data-plugin-codemirror data-plugin-options='{ "mode": "text/html" }'></textarea>
                </div>
                <div class="form-group">
                    <label for="">Style</label>
                    <textarea rows="1" class="form-control" id="codemirror_html_code" name="style" data-plugin-codemirror data-plugin-options='{ "mode": "text/html" }'></textarea>
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