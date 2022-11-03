<a class="modal-with-form btn btn-default" href="#CreateConfiguracion">Nueva Configuracion</a>

<div id="CreateConfiguracion" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro Configuracion</h2>
        </header>
        {!!Form::open(['route' => 'configuracion.store', 'method' => 'POST'])!!}
            <div class="card-body">

                <div class="form-group">
                    <label for="">Prefix</label>
                    {!!Form::select('prefix',['Private'=>'Private','Portal'=>'Portal','Login'=>'Login','Dgr'=>'Dgr'],null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>

                <div class="form-group">
                    <label for="">Variable</label>
                    {!!Form::text('variable',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>

                <div class="form-group">
                    <label for="">Valor</label>
                    <textarea rows="2" class="form-control" id="codemirror_html_code" name="valor" data-plugin-codemirror data-plugin-options='{ "mode": "text/html" }'></textarea>
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