@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Administrador</h5>
            </div>
        </div>

    </div>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card card-custom card-fit card-border">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-pin text-primary"></i>
                        </span>
                        <h3 class="card-label">Editar Residuo N°{{$solicitud->id}}</h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                {!!Form::open(['url' => 'workflow/pesaje/indumodificar', 'method' => 'POST'])!!}
            <div class="row">
                <div class="col-6">
                  <label>Grupo</label>
                  <select class="form-control" name="grupo" id="grupo" onchange="clasificaciones(this.value)">
                      <option value="">Seleccionar</option>
                      @foreach($grupo as $group)
                        @if($solicitud->grupos_id == $group->id)
                          <option value="{{ $group->id }}" selected>{{ $group->nombre }}</option>
                        @else
                          <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
              <div class="col-6">
                  <label>Categoria</label>
                  <select class="form-control" name="clasificacion" id="clasi" onchange="subcategoriaBuscar(this.value);">
                      <option value="">Seleccionar</option>
                      @foreach($categorias as $categoria)
                        @if($solicitud->clasificaciones_id == $categoria->id)
                          <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                        @else
                          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
              <div class="col-6">
                  <label>Subcategoria</label>
                  <select class="form-control" name="subcategoria" id="subcate">
                      <option value="">Seleccionar</option>
                      @foreach($subcategorias as $sub)
                        @if($solicitud->subcategoria_id == $sub->id)
                          <option value="{{ $sub->id }}" selected>{{ $sub->nombre }}</option>
                        @else
                          <option value="{{ $sub->id }}">{{ $sub->nombre }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
              <div class="col-6">
                  <label>Estado de los Residuos</label>
                  <select class="form-control" name="tipo_producto" id="tipo_pro" onchange="otroEstado(this.value);">
                      <option value="">Seleccionar</option>
                      @foreach($tipo_producto as $tipo)
                        @if($solicitud->tipo_producto_id == $tipo->id)
                          <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                        @else
                          <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endif
                      @endforeach
                      <option value="otro">Otro</option>
                  </select>
              </div>
              @if($solicitud->otro_estado == null)
              <div class="col-6" style="display:none;" id="div_otro_estado">
                  <label>Otro Estado</label>
                  <input type="text" class="form-control" name="otro_estado" id="otro_estado">
              </div>
              @else
              <div class="col-6" style="display:block;" id="div_otro_estado">
                  <label>Otro Estado</label>
                  <input type="text" value="{{$solicitud->otro_estado}}" class="form-control" name="otro_estado" id="otro_estado">
              </div>
              @endif
{{--               <div class="form-group">
                  <label>Cantidad</label>
                  <input type="number" class="form-control" name="cantidad" id="cantidad">
              </div> --}}
                <div class="col-6">
                  <label>Peso (En Kilos)</label>
                   <input type="number" value="{{$solicitud->peso}}" class="form-control" name="peso" id="peso">
                </div>
              <div class="col-6">
                  <label>Observaciones/Detalle Retiro (Opcional)</label>
                  <input type="text" value="{{$solicitud->detalle_retiro}}" class="form-control" name="detalle_retiro" >
              </div>
              <input type="hidden" name="sol_id" value="{{$solicitud->id}}">
            <input type="hidden" name="boletas_id" id="boletas_hidden_id" value="{{$boleta->id}}">
              <div class="col-12" style="text-align: right;">
                  <button class="btn btn-primary" type="submit" style="margin-right: 1%;">Actualizar</button>
                  <a href="{{ asset('workflow/pesaje/'.$boleta->id) }}" class="btn btn-danger">Volver</a>
              </div>
                {!!Form::close()!!}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  function otroEstado(id){
    if(id == 'otro'){
      document.getElementById('div_otro_estado').style.display = "block";
    }else{
      document.getElementById('div_otro_estado').style.display = "none";
    }
  }

  //clasificacion de producto
  function clasificaciones(id) {
    var select = `<option value="">Seleccionar</option>`;
    $.get('{{ asset('api/grupo-clasificacion') }}/'+id, function(data, status) {
      for (var i = 0; i < data.length; i++) {
        select += `<option value="${data[i].id}">${data[i].nombre}</option>`;
      }
      document.getElementById('clasi').innerHTML = select;
    });
  }

  //subcategoria de producto
  function subcategoriaBuscar(id) {
    var select = `<option value="">Seleccionar</option>`;
    $.get('{{ asset('api/clasificacion-subcategoria') }}/'+id, function(data, status) {
      for (var i = 0; i < data.length; i++) {
        select += `<option value="${data[i].id}">${data[i].nombre}</option>`;
      }
      document.getElementById('subcate').innerHTML = select;
    });
  }

</script>