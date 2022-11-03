<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$producto->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-producto.update',$producto->id],'files'=>true,'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Producto
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label">
                        Nombre
                    </label>
                    {!!Form::text('nombre',$producto->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Descripción
                    </label>
                    {!!Form::text('descripcion',$producto->descripcion,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label>Características</label>
                    <textarea class="ckeditor" name="caracteristicas" >{{$producto->caracteristicas}}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Valor
                    </label>
                    {!!Form::number('precio',$producto->precio,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Stock
                    </label>
                    {!!Form::number('stock',$producto->stock,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Marca
                    </label>
                    <select class="form-control kt-select2" id="kt_select2_2" name="td_marcas_id" required="required" style="width: 100%">
                        <option value="">Seleccione</option>
                        @foreach ($marcas as $marca)
                            @if ($marca->nombre == $producto->marca['nombre'])
                                <option value="{{$marca->id}}" selected="selected">{{$marca->nombre}}</option>
                            @else
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Categoría
                    </label>
                    <select class="form-control kt-select2" id="kt_select2_2" name="td_categorias_id" required="required" style="width: 100%">
                        <option value="">Seleccione</option>
                        @foreach ($categorias as $cat)
                            @if ($cat->nombre == $producto->categoria['nombre'])
                                <option value="{{$cat->id}}" selected="selected">{{$cat->nombre}}</option>
                            @else
                                <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label class="form-control-label">
                        Descuentos
                    </label>
                    <select class="form-control kt-select2" name="td_descuentos_id" required="required" style="width: 100%">
                        <option value="">Seleccione</option>
                        @foreach ($descuentos as $desc)
                            @if ($desc->nombre == $producto->descuentos['nombre'])
                                <option value="{{$desc->id}}" selected="selected">{{$desc->nombre}}</option>
                            @else
                                <option value="{{$desc->id}}">{{$desc->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div> --}}
                <div class="row">
                    <div class="form-group col-6">
                       <label>Imagen 1</label>
                       <input type="file" name="imagen" value="{{ $producto->imagen }}" class="form-control">
                    </div>
                    <div class="form-group col-6">
                       <label>Imagen 2</label>
                       <input type="file" name="imagen2" value="{{ $producto->imagen2 }}" class="form-control">
                    </div>
                    <div class="form-group col-6">
                       <label>Imagen 3</label>
                       <input type="file" name="imagen3" value="{{ $producto->imagen3 }}" class="form-control">
                    </div>
                    <div class="form-group col-6">
                       <label>Imagen 4</label>
                       <input type="file" name="imagen4" value="{{ $producto->imagen4 }}" class="form-control">
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>