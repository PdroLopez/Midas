<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Producto <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        {!!Form::open(['route' => 'mantenedor-producto.store', 'method' => 'POST','files'=>true,'enctype'=>'multipart/form-data'])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Producto
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body row">
{{--                 <div class="form-group col-6">
                   <label>Nombre</label>
                   <input type="text" name="nombre" class="form-control"> 
                </div>
                <div class="form-group col-6">
                   <label>Valor</label>
                   <input class="form-control" name="precio" type="text">
                </div>
                <div class="form-group col-6">
                   <label>Descripción</label>
                   <input type="text" name="descripcion" class="form-control"> 
                </div>
                <div class="form-group col-12">
                   <label>Características</label>
                   <textarea class="form-control ckeditor" name="caracteristicas" ></textarea>
                </div>
                <div class="form-group col-6">
                   <label>Stock</label>
                   <input type="number" name="stock" class="form-control"> 
                </div>
                <div class="form-group col-6">
                   <label>Marca</label>
                   <select class="form-control" name="td_marcas_id" required="required">
                        <option value="">Seleccione</option>
                        @foreach ($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                   <label>Categoría</label>
                   <select class="form-control" name="td_categorias_id" required="required">
                        <option value="">Seleccione</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div> --}}
                {{-- <select class="form-control" name="td_descuentos_id" required="required">
                    <option value="">Seleccione</option>
                    @foreach ($descuentos as $desc)
                        <option value="{{$desc->id}}">{{$desc->nombre}}</option>
                    @endforeach
                </select> --}}
                <div class="form-group col-6">
                   <label>Imagen 1</label>
                   <input type="file" name="imagen" class="form-control">
                </div>  
                <div class="form-group col-6">
                   <label>Imagen 2</label>
                   <input type="file" name="imagen2" class="form-control">
                </div>  
                <div class="form-group col-6">
                   <label>Imagen 3</label>
                   <input type="file" name="imagen3" class="form-control">
                </div>  
                <div class="form-group col-6">
                   <label>Imagen 4</label>
                   <input type="file" name="imagen4" class="form-control">
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