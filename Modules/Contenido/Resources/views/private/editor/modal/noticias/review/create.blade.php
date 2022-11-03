<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        {!!Form::open(['route' => 'mantenedor-review.store', 'method' => 'POST','files'=>true])!!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form files="true">
        <div class="modal-body">
            @csrf
            <div class="form-group">
               <label>titulo</label>
               <input type="text" name="titulo" class="form-control"> 
            </div>
            <div class="form-group">
               <label>Subtitulo</label>
               <textarea class="form-control" name="subtitulo" ></textarea>
            </div>
            <div class="form-group">
               <label>Mensaje final</label>
               <textarea class="form-control" name="msj_final" ></textarea>
            </div>
            <div class="form-group">
               <label>Imagen portada</label>
               <input type="file" name="imagenPortada" class="form-control">
            </div>
            <div class="form-group">
               <label>Imagen miniatura</label>
               <input type="file" name="imagenMiniatura" class="form-control">
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





