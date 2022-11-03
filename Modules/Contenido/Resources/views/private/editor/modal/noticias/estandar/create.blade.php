<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#noticiasEstandar">
  Nuevo
</button>
<script src="./assets/js/demo1/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
<div class="modal fade" id="noticiasEstandar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
      {!!Form::open(['route' => 'mantenedor-noticias.store', 'method' => 'POST','files'=>true])!!}
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Crear noticia estandar</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <div class="modal-body row">
            <div class="form-group col-6">
               <label>Titulo</label>
               <input type="text" name="titulo" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Breve Reseña</label>
               <input class="form-control" name="subtitulo" type="text">
            </div>
            <div class="form-group well col-12">
                <label for="tags">Etiquetas (palabras separadas por coma)</label>
                <input type="text" name="tags" data-role="tagsinput" class="form-control">
            </div>
            <div class="form-group col-12">
               <label>Noticia Completa</label>
               <textarea class="form-control" name="descripcion" ></textarea>
            </div>
            <div class="form-group col-6">
               <label>URL de redirección</label>
               <input type="text" name="url" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen detalle</label>
               <input type="file" name="imagenDetalle" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen portada</label>
               <input type="file" name="imagenPortada" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen descripción</label>
               <input type="file" name="imagenDescripcion" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen miniatura</label>
               <input type="file" name="imagenMiniatura" class="form-control">
            </div>
            <div class="form-group col-12">

                <label>Categorias</label>
                <select class="form-control kt-select2" id="kt_select2_3" style="width:100%;" placeholder="Seleccione una Categoria..." onchange="categoriasxd();" name="categorias[]" multiple="multiple">
                    <option value="">
                        TODOS
                    </option>
                    @foreach ($categorias_a as $item)
                        <?php $cont = 0;?>
                        @foreach ($categorias_a as $cat)
                            @if ($cat->id == $item->id)
                                <?php $cont++;?>
                                <option value="{{ $item->id }}" >
                                    {{ $item->nombre }}
                                </option>
                            @endif
                        @endforeach
                        @if($cont==0)
                        <option value="{{$item->id}}">
                            {{$item->nombre}}
                        </option>
                   @endif
                    @endforeach
                </select>
                {{-- <select id="my-select" class="form-control" name="categorias">
                    <option value="noticias">Noticias</option>
                    <option value="educacion">Educacion</option>
                </select> --}}
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
           {!!Form::close()!!}
       </div>
   </div>
</div>
<script>
    function categoriasxd()
    {

    }
</script>
