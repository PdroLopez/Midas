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
                        <h3 class="card-label">Editar Residuo N°{{$solicitud->id}}
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                {!!Form::open(['url' => 'workflow/pesaje/partmodificar', 'method' => 'POST','files'=>true])!!}
          <div class="row">
                  <div class="col-12">
                    <label>Residuos</label>
                  <select class="form-control" name="residuo" id="grupo" onchange="radioProducto(this.value);">
                      <option value="">Seleccionar</option>
                      @foreach($residuo as $res)
                        @if($solicitud->Residuos_id == $res->id)
                          <option value="{{ $res->id }}" selected>{{ $res->nombre }} - {{$res->altura}} cm x {{$res->largo}} cm x {{$res->ancho}} cm</option>
                        @else
                          <option value="{{ $res->id }}">{{ $res->nombre }} - {{$res->altura}} cm x {{$res->largo}} cm x {{$res->ancho}} cm</option>
                        @endif
                      @endforeach
                      <option value="0">Otro</option>
                  </select>
                  </div>
            </div>
            {{-- <div class="form-group">
                <label>Producto</label>
                <select class="form-control" name="producto" id="producto">
                  <option value="">Seleccione...</option>
                  @foreach($residuo as $res)
                    <option value="{{ $res->id }}">{{ $res->nombre }}</option>
                  @endforeach
                </select>
            </div> --}}
            <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                        <label>Peso Aprox. (KG)</label>
                        <input type="number" value="{{$solicitud->peso}}" name="peso" class="form-control" placeholder="" id="peso">
                    </div>
                  </div>
                  <div class="col-6">
                      <div class="form-group">
                          <label>Cantidad</label>
                          <input type="number" name="cantidad"  value="{{$solicitud->cantidad}}" class="form-control" placeholder="" id="cantidad">
                      </div>
                  </div>
              </div>
            @if($solicitud->Residuos_id == null)
            <div id="div_valoresnuevos" style="display:block;">
            @else
            <div id="div_valoresnuevos" style="display:none;">
            @endif
                <div class="row" >
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="{{$solicitud->nombre}}" class="form-control" placeholder="" id="nombre">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Altura (CM)</label>
                            <input type="number" name="altura" value="{{$solicitud->altura}}" class="form-control" placeholder="" id="altura">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Largo (CM)</label>
                            <input type="number" name="largo" value="{{$solicitud->largo}}" class="form-control" placeholder="" id="largo">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Ancho (CM)</label>
                            <input type="number" name="profundo" value="{{$solicitud->profundidad}}" class="form-control" placeholder="" id="profundo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                  <label for="exampleTextarea">Motivo</label>
                  <input type="text" name="motivo" value="{{$solicitud->motivo}}" class="form-control" placeholder="" > 
                </div>
                <div class="col-6">
                    <label>Fotos</label>
                    <input type="file" name="file" id="fotos-producto" class="form-control">
                </div>
            </div>
            <input type="hidden" name="sol_id" value="{{$solicitud->id}}">
            <input type="hidden" name="boletas_id" id="boletas_hidden_id" value="{{$boleta->id}}">

            <br>
            <div class="col-12" style="text-align: right;">
                  <button class="btn btn-primary" type="submit" style="margin-right: 1%;">Actualizar</button>
                  <a href="{{ asset('workflow/pesaje/'.$boleta->id) }}" class="btn btn-danger">Volver</a>
              </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection
  <script>
    function radioProducto(id){
        document.getElementById('producto_elegido').value = id;
        if(id == 0){
            document.getElementById('div_valoresnuevos').style.display = "block";
        }else{
            document.getElementById('div_valoresnuevos').style.display = "none";
        }
  }

</script>