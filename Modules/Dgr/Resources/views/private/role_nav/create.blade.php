
<a class="modal-with-form btn btn-default" href="#CreateNavRol">Nuevo nav role</a>

<div id="CreateNavRol" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de nav role</h2>
        </header>
        {!!Form::open(['route' => 'nav-rol.store', 'method' => 'POST'])!!}
            <div class="card-body">
                
                <div class="form-group">
                    <label for="">Modulo</label>
                    {!!Form::select('modulos_id',$modulos,null,['class'=>"form-control", 'placeholder'=>"Seleccione"])!!}
                </div>
                <div class="form-group">
                    <label for="">Rol</label>
                    {!!Form::select('roles_id',$rol,null,['class'=>"form-control", 'placeholder'=>"Seleccione",'required'])!!}
                </div>
                <div class="form-group">
                    <label for="">Nav</label>
                    {!!Form::select('private_nav_id',$private_nav,null,['class'=>"form-control", 'placeholder'=>"Seleccione",'required'])!!}
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