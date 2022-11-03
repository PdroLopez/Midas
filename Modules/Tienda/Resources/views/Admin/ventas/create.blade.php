<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create-venta" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Crear Venta Corta
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            {!! Form::open(['route' => 'venta-corta.create','files'=>true,'enctype' => 'multipart/form-data' ,'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label>Producto</label>
                    <input value="{{$producto->nombre}}/Valor ${{$producto->precio}}" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Cantidad</label>
                    <input name="cantidad" type="number" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                    <label>Tipo Venta</label>
                    <select name="tipo_venta_id" class="form-control">
                        <option value="0">Seleccionar</option>
                        @foreach($tipo_venta as $ti_ve)
                            <option value="{{$ti_ve->id}}">{{$ti_ve->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo Venta</label>
                    <select name="tipo_pago" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="webpay">WebPay Transferencia Electronica</option>
                        <option value="transbank">Pos Móvil Transbank</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia APP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    {!!Form::select('estado',['incompleto'=>'Incompleto','por pagar'=>'Por Pagar','pagado'=>'Pagado','no pagado'=>'No Pagado'],null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                </div>
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input name="nombre" type="text" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                    <label>Celular</label>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button class="btn btn-default" >+ 56 9</button>
                      </div>
                      <input name="telefono" type="text" pattern=".{8,8}" maxlength="8" class="form-control" placeholder="87654321" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Correo electrónico ( Opcional )</label>
                    <div class="input-group">
                      <input name="correo" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Región</label>
                        <select name="bk_regiones_id" class="form-control" onchange="BuscarComuna(this.value);">
                            <option value="0">Seleccionar</option>
                            @foreach($region as $re)
                                <option value="{{$re->id}}">{{$re->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Comuna</label>
                        <select name="bk_comunas_id" id="comuna_select" class="form-control" onchange="despachoElegido(this.value)">
                            <option value="0">Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="div_despacho">
                </div>
                <div class="form-group">
                      <label>Dirección</label>
                      <input name="direccion" type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                      <label>Algún detalle de Dirección</label>
                      <input name="detalle" type="text" class="form-control" placeholder="">
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
            {!! Form::close() !!}
        </div>

    </div>
</div>
<script type="text/javascript">
  function BuscarComuna(id){
    $.get("{{ asset('tienda/venta-corta/buscar-comuna') }}/"+id,function(response, compania){
        $("#comuna_select").empty();
        $("#comuna_select").append(`<option value="0">Seleccionar</option>`);
        response.forEach(element => {
          $("#comuna_select").append(`<option value="${element.id}"> ${element.nombre} </option>`);
        });
    });
  }

  function despachoElegido(id){
    $.get("{{ asset('tienda/venta-corta/despacho-elegido') }}/"+id,function(response, compania){
        // alert(response.valor);
        // var select = `Despacho tiene un valor de $ ${response.valor}`;
        if(response.bk_cobertura_id == 2){
            var despacho = `<label>Despacho será vía Starken envio por pagar</label>`;
        }else{
            var despacho = `<label>Despacho será por Midas, con un valor de $${response.costo}</label>`;
        }
        document.getElementById('div_despacho').innerHTML = despacho;
    });
  }
</script>