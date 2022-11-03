<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="#EditVariable_{{$config->id}}"><i class="fas fa-edit"></i></a>

<div id="EditVariable_{{$config->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Editar Configurcion {{$config->variable}}</h2>
        </header>
            {!!Form::open(['route' => ['configuracion.update',$config->id], 'method' => 'PUT'])!!}
                <div class="card-body">
                <div class="form-group">
                    <label for="">Prefix</label>
                    {!!Form::select('prefix',['Private'=>'Private','Portal'=>'Portal','Login'=>'Login','Dgr'=>'Dgr'],$config->prefix,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>

                <div class="form-group">
                    <label for="">Variable</label>
                    {!!Form::text('variable',$config->variable,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                </div>

                <div class="form-group">
                    <label for="">Valor</label>
                    <textarea rows="2" class="form-control" id="codemirror_html_code" name="valor" data-plugin-codemirror data-plugin-options='{ "mode": "text/html" }'>{{$config->valor}}</textarea>
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
