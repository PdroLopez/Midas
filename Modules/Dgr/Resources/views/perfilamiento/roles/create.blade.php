<a class="modal-with-form btn btn-default" href="#CreateRol">Nuevo rol</a>

<div id="CreateRol" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de rol</h2>
        </header>
        {!!Form::open(['route' => 'roles.store', 'method' => 'POST'])!!}
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre</label>
                    {!!Form::text('name',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
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