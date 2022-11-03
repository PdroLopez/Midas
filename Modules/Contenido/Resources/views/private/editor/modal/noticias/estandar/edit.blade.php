<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$noticias->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-noticias.update',$noticias->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Noticia Estandar
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label">
                                Titulo
                            </label>
                            {!!Form::text('subtitulo',$noticias->titulo,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Breve Reseña</label>

                            {!!Form::text('subtitulo',$noticias->titulo,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label">
                                Slug
                            </label>
                            {!!Form::text('slug',$noticias->slug,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group well">
                            <label for="tags">Etiquetas (palabras separadas por coma)</label>
                            <input type="text" name="tags" data-role="tagsinput" class="form-control" value="{{ $noticias->tags }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="ckeditor" name="descripcion" >{{$noticias->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-control-label">
                                URL
                            </label>
                            {!!Form::text('url',$noticias->url,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                        </div>
                    </div>


                </div>
                {{--




                --}}


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
