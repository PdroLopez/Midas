<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$imagen->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => ['mantenedor-slider.update',$imagen->id],'files'=>true, 'method' => 'PUT']) !!}
            {!! Form::hidden('nombre', 'nombre') !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Slider
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Imagen </label>
                            <img src="{{asset('storage/'.$imagen->ruta)}}"  width="200" height="100">
                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Imagen (Tamaño Recomendado 915x500)</label>
                            <input type="file" name="archivo" class="form-control">
                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Texto Principal</label>
                            {!!Form::text('texto_principal',$imagen->texto_principal,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..." ])!!}
                         </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Texto Secundario</label>
                            {!!Form::text('texto_secundario',$imagen->texto_secundario,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..." ])!!}

                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Texto Botón</label>
                            {!!Form::text('btn_texto',$imagen->btn_texto,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..." ])!!}

                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Url Botón</label>
                            {!!Form::text('btn_url',$imagen->btn_url,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..."])!!}

                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Atributo</label>
                            {!!Form::text('atributo',$imagen->atributo,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..."])!!}

                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Activo</label>
                            {!!Form::text('active',$imagen->active,['class'=>"form-control", 'placeholder'=>"Ingrese un texto..."])!!}

                         </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="custom-select" name="ct_categoria_slider_id" required>
                               <option value=""  >Seleccione</option>
                               @foreach($categorias as $categoria)
                                @if ($categoria->id == $imagen->ct_categoria_slider_id)
                                  <option value="{{ $categoria->id }}" selected >{{ $categoria->nombre }} </option>

                                @else
                                   <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>

                                @endif
                                 {{-- <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option> --}}
                               @endforeach
                             </select>
                         </div>
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
