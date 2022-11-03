<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$pages->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-page.update',$pages->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Pagina
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                    <label class="form-control-label">
                        Titulo
                    </label>
                    {!!Form::text('titulo',$pages->titulo,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
              </div>
            <div class="form-group">
                    <label class="form-control-label">
                        SubTitulo
                    </label>
                    {!!Form::text('subtitulo',$pages->subtitulo,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
              </div>
             <div class="form-group">
                    <label class="form-control-label">
                        Alias
                    </label>
                    {!!Form::text('alias',$pages->alias,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
              </div>
            <div class="form-group">
                    <label class="form-control-label">
                        Peso
                    </label>
                    {!!Form::number('peso',$pages->peso,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
              </div>
            <div class="form-group">
              <label>Body</label>
               <textarea class="form-control" id="TextAB" rows="10" name="body" data-plugin-codemirror data-plugin-options="{ "mode": "text/html" }">{{ $pages->body }}</textarea>
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



          