<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editproducto{{$pro_sel->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['url' => ['workflow/update/productopesaje'],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Residuo
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                      <label>Grupo</label>
                      <select class="form-control" name="grupo" id="grupo" onchange="clasificaciones(this.value)">
                          <option value="">Seleccionar</option>
                          @foreach($grupo as $group)
                              <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                      <label>Categoria</label>
                      <select class="form-control" name="clasificacion" id="clasi" onchange="subcategoriaBuscar(this.value);">
                          <option value="">Seleccionar</option>
                      </select>
                </div>
                <div class="form-group">
                      <label>Subcategoria</label>
                      <select class="form-control" name="subcategoria" id="subcate">
                          <option value="">Seleccionar</option>
                      </select>
                </div>
                <div class="form-group">
                      <label>Estado de los Residuos</label>
                      <select class="form-control" name="tipo_producto" id="tipo_pro" onchange="otroEstado(this.value);">
                          <option value="">Seleccionar</option>
                          @foreach($tipo_producto as $tipo)
                              <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                          @endforeach
                          <option value="otro">Otro</option>
                      </select>
                </div>
                <div class="form-group" style="display:none;" id="div_otro_estado">
                      <label>Otro Estado</label>
                      <input type="text" class="form-control" name="otro_estado" id="otro_estado">
                </div>
                <div class="form-group row">
                    <div class="col-6">
                      <label>Peso (En Kilos)</label>
                       <input type="number" class="form-control" name="peso" id="peso">
                    </div>
                    <div class="col-6">
                        <label>Destrucción Certificada</label><br>
                        <input type="radio" name="des_certificada" value="0" checked>
                        <label>Si</label>
                        <input type="radio" name="des_certificada" value="1">
                        <label>No</label><br>
                    </div>
                </div>
                <div class="form-group">
                      <label>Observaciones/Detalle Retiro (Opcional)</label>
                      <textarea class="form-control" name="detalle_retiro" id="detalle_retiro">  </textarea>
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




