<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Direccion de  Usuarios <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-direccion_empresas.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Direccion de Usuarios
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                
    
                    <div class="form-group mb-5">
                        <select name="bk_regiones_id" id="region" class="form-control" placeholder="Seleccione una Region">
          
                          <option value="">Seleccione una Región</option>
                          @foreach($region as $regiones)
                              <option value="{{ $regiones->id }}">{{ $regiones->nombre }}</option>
                          @endforeach
                        </select>
          
          
                      </div>
          
                      <div class="form-group mb-5">
                          <select name="bk_comunas_id" id="comuna" class="form-control h-auto form-control-solid py-4 px-8" placeholder="Seleccione una Region">
          
                            <option value="">Seleccione una Comuna</option>
          
                          </select>
          
          
                      </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Registrar
                </button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
