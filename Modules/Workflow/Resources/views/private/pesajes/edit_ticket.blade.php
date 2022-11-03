@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
						<h3 class="card-label">Ingreso de Pesaje Boleta N°{{$boleta->codigo}}</h3>
					</div>
					<div class="card-toolbar">
                    <a href="{{asset('workflow/pesajes')}}" class="btn btn-sm btn-primary font-weight-bold">Volver a Solicitudes</a>
                    {{-- <a class="btn btn-sm btn-primary font-weight-bold" style="margin:10px;" data-toggle="modal" data-target="#terminarpesaje">
						<i class="flaticon2-gear"></i>Terminar Pesaje</a> --}}
					</div>
                    {{-- @include('workflow::private.terminar_pesaje') --}}
{{--                     @if($boleta->empresas_id != null)
                        @include('workflow::private.pesajes.productos_industrial')
                    @else
                        @include('workflow::private.pesajes.productos_particular')
                    @endif --}}
				</div>
                <div class="card-header">
                    <div class="row">    
                        <div class="col-xl-7">
                            <div class="row">    
                                <div class="col-xl-3">
                                    CLIENTE
                                </div>
                                <div class="col-xl-9">
                                    : @if($boleta->empresas_id != null)
                                        {{ $boleta->empresas->nombre }}
                                    @else
                                        @if($boleta->user)
                                            {{ $boleta->user->name }} {{ $boleta->user->apellido }}
                                        @else
                                            {{ $boleta->nombre}}
                                        @endif
                                    @endif
                                </div>
                                <div class="col-xl-3">
                                    RUT
                                </div>
                                <div class="col-xl-9">
                                    : @if($boleta->empresas_id != null)
                                        {{ $boleta->empresas->rut }}
                                    @else
                                        @if($boleta->user)
                                            {{ $boleta->user->rut }}-{{ $boleta->user->dv}}
                                        @else
                                           No tiene rut
                                        @endif
                                    @endif
                                </div>
                                <div class="col-xl-3">
                                    ORIGEN
                                </div>
                                <div class="col-xl-9">
                                    : @if($boleta->empresas_id != null)
                                        @if($boleta->bk_direcciones_empresas_id != null)
                                            @if($boleta->direccion_empresa != null)
                                                {{ $boleta->direccion_empresa->nombre }}, 
                                                @if ($boleta->direccion_empresa->bk_comunas_id != null)
                                                    {{ $boleta->direccion_empresa->comuna->nombre }},
                                                @else
                                                    Sin Comuna,
                                                @endif
                                                @if ($boleta->direccion_empresa->bk_regiones_id != null)
                                                    {{ $boleta->direccion_empresa->region->nombre}}.
                                                @else
                                                    Sin Región.
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    @if($boleta->users_id != null)
                                        @if($boleta->direccion != null)
                                            @if ($boleta->direccion->nombre != null)
                                            {{ $boleta->direccion->nombre }},
                                            @else
                                            Sin Calle,
                                            @endif
                                            @if ($boleta->direccion->bk_comunas_id != null)
                                            {{ $boleta->direccion->comuna->nombre }}, 
                                            @else
                                             Sin Comuna, 
                                            @endif
                                            @if ($boleta->direccion->bk_regiones_id != null)
                                                {{ $boleta->direccion->region->nombre }}.
                                            @else
                                            Sin Región.
                                            @endif
                                        @else
                                            {{ $boleta->direccion_rc }} {{ $boleta->detalle }},
                                            @if ($boleta->comuna_id != null)
                                                {{ $boleta->comuna->nombre }}, 
                                            @else
                                                Sin Comuna, 
                                            @endif
                                            Metropolitana de Santiago.
                                        @endif
                                    @endif
                                </div>
                                <div class="col-xl-3">
                                    G. DESPACHO
                                </div>
                                <div class="col-xl-9">
                                    : <input type="text" name="n_guia_despacho" id="id_text_despacho" value="{{ $boleta->n_guia_despacho }}" onblur="EditarNGuiaDNContenedor()">
                                </div>
                            </div>
                        </div>  
                        <div class="col-xl-5">
                            <div class="row">    
                                <div class="col-xl-5">
                                    FECHA
                                </div>
                                <div class="col-xl-7">
                                    : {{ $boleta->fecha_hora }}
                                </div>
                                <div class="col-xl-5">
                                    CONDUCTOR
                                </div>
                                <div class="col-xl-7">
                                    : @if ($boleta->chofer != null )
                                            {{$boleta->chofer->name}}
                                        @else
                                            Sin Chofer
                                        @endif
                                </div>
                                <div class="col-xl-5">
                                    PATENTE
                                </div>
                                <div class="col-xl-7">
                                    : @if ($boleta->camiones != null )
                                            {{$boleta->camiones->patente}}
                                        @else
                                            Sin Camiones
                                        @endif
                                </div>
                                <div class="col-xl-5">
                                    N° CONTENEDOR
                                </div>
                                <div class="col-xl-7">
                                    : <input type="text" name="n_contenedor" id="id_text_contenedor" value="{{ $boleta->n_contenedor }}" style="width: 60%;" onblur="EditarNGuiaDNContenedor()">
                                </div>
                            </div>
                            <input type="hidden" name="id" id="boletas_hidden_id" value="{{$boleta->id}}">
                        </div>
                    </div>
                    <br>
                </div>
			</div>
        </div>
    </div>
</div>
<br>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <table class="table table-bordered table-checkable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Peso Bruto (Kg)</th>
                        <th>Peso Envase (Kg)</th>
                        <th>Peso Neto (Kg)</th>
                        <th>Peso Cliente (Kg)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total_peso_bruto = 0;
                        $total_peso_interno  = 0;
                        $total_peso_neto = 0; 
                        $diferencia = 0; 
                        $diferencia_cliente = 0; 
                        $count_producto = 1;
                    ?>
                    @if(Session::has('edit_solicitudes_pesaje'))
                        @foreach (Session::get('edit_solicitudes_pesaje') as $producto)
                            <tr>
                                <td>{{ $count_producto }}</td>
                                @if ($producto->solicitud->Residuos_id != null)
                                    <td>{{ $producto->solicitud->residuos->nombre }}</td>
                                @else
                                    @if($producto->solicitud->grupos_id != null)
                                        <td>{{$producto->solicitud->grupo->nombre}}, {{$producto->solicitud->clasificacion->nombre}}</td> 
                                    @else
                                        <td>{{$producto->solicitud->nombre}}</td> 
                                    @endif
                                @endif
                                <td>
                                    {{ $producto->solicitud->peso_bruto }}
                                </td>
                                <td>
                                    {{ $producto->solicitud->peso_interno }}
                                </td>
                                <td>
                                   {{ $producto->solicitud->peso_neto }}
                                </td>
                                <td>
                                   {{ $producto->solicitud->peso }}
                                </td>
                                <td>
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones</button>
                                        <!--begin::Dropdown Menu-->
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav flex-column nav-hover">
                                                <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                                <li class="nav-item">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#edit{{ $producto->solicitud->id }}">Editar</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>

                                </td>
                            </tr>
                            <?php 
                                $total_peso_bruto = $total_peso_bruto+$producto->solicitud->peso_bruto;
                                $total_peso_interno  = $total_peso_interno+$producto->solicitud->peso_interno;
                                $total_peso_neto = $total_peso_neto+$producto->solicitud->peso_neto;
                                $count_producto = $count_producto+1;
                                $diferencia_cliente = $producto->solicitud->peso+$diferencia_cliente;
                            ?>
                            @include('workflow::private.edit_pesajeditsession')
                        @endforeach
                    @else
                        @foreach ($boleta->solicitudes as $producto)
                            <tr>
                                <td>{{ $count_producto }}</td>
                                @if ($producto->solicitud->Residuos_id != null)
                                    <td>{{ $producto->solicitud->residuos->nombre }}</td>
                                @else
                                    @if($producto->solicitud->grupos_id != null)
                                        <td>{{$producto->solicitud->grupo->nombre}}, {{$producto->solicitud->clasificacion->nombre}}</td> 
                                    @else
                                        <td>{{$producto->solicitud->nombre}}</td> 
                                    @endif
                                @endif
                                <td>
                                    {{ $producto->solicitud->peso_bruto }}
                                </td>
                                <td>
                                    {{ $producto->solicitud->peso_interno }}
                                </td>
                                <td>
                                   {{ $producto->solicitud->peso_neto }}
                                </td>
                                <td>
                                   {{ $producto->solicitud->peso }}
                                </td>
                                <td>
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones</button>
                                        <!--begin::Dropdown Menu-->
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav flex-column nav-hover">
                                                <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                                <li class="nav-item">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#edit{{ $producto->solicitud->id }}">Editar</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>

                                </td>
                            </tr>
                            <?php 
                                $total_peso_bruto = $total_peso_bruto+$producto->solicitud->peso_bruto;
                                $total_peso_interno  = $total_peso_interno+$producto->solicitud->peso_interno;
                                $total_peso_neto = $total_peso_neto+$producto->solicitud->peso_neto;
                                $count_producto = $count_producto+1;
                                $diferencia_cliente = $producto->solicitud->peso+$diferencia_cliente;
                            ?>
                            @include('workflow::private.edit_pesajedit')
                        @endforeach
                    @endif
                        <tr>
                            <td colspan="2">TOTALES</td>
                            <td>
                                {{ $total_peso_bruto }}
                            </td>
                            <td>
                                {{ $total_peso_interno }}
                            </td>
                            <td>
                               {{ $total_peso_neto }}
                            </td>
                            <td>
                               {{ $diferencia_cliente }}
                            </td>
                            <td>
{{--                                 {{$diferencia}} --}}
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card card-custom card-fit card-border">
                {!! Form::open(['url' => 'workflow/pesaje/edit-ticket','files'=>true, 'method' => 'POST']) !!}
                <div class="card-header">
                    <?php 
                        $diferencia = $total_peso_neto-$diferencia_cliente;
                    ?>
                    <div class="row">    
                        <div class="col-xl-7">
                            DIFERENCIA CON PESAJE INFORMADO POR CLIENTE: <b>Total Cliente {{$diferencia_cliente}} Kg</b>
                        </div>
                        <div class="col-xl-2">
                            <input type="number" name="diferencia_peso_kg" style="width: 60%;" readonly value="{{$diferencia}}"> KG
                        </div>
                        <div class="col-xl-3" style="text-align:left;">
                            @if($diferencia > 0)
                                <input type="radio" name="diferencia_peso" value="1" checked>
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2">
                                <label>Contra</label><br>
                            @elseif($diferencia < 0)
                                <input type="radio" name="diferencia_peso" value="1">
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2" checked>
                                <label>Contra</label><br>
                            @elseif($diferencia == 0)
                                <input type="radio" name="diferencia_peso" value="1">
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2">
                                <label>Contra</label><br>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">  
                        <div class="col-xl-3">
                            TIPO CARGA
                        </div>
                        <div class="col-xl-9">
                            <select class="form-control" name="tipo_producto" onchange="otroEstadoTicket(this.value);" required>
                                <option value="">Seleccionar</option>
                                @foreach($tipo_producto as $tipo)
                                    @if($ticket->tipo_producto_id == $tipo->id)
                                        <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                                    @else
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endif
                                @endforeach
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    @if($ticket->tipo_producto_id != null)
                    <div  style="display:none;" id="tipo_pro_ticket">
                    @else
                    <div  style="display:block;" id="tipo_pro_ticket">
                    @endif
                        <div class="row">                      
                            <div class="col-xl-3">
                                OTRO ESTADO
                            </div>
                            <div class="col-xl-9">
                                <input type="text" value="{{$ticket->otro_estado}}" class="form-control" name="otro_estado_ticket">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">                      
                        <div class="col-xl-3">
                            OBSERVACIONES
                        </div>
                        <div class="col-xl-9">
                            <textarea class="form-control" name="observaciones_ticket" rows="2">{{$ticket->observaciones}}</textarea> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">    
                        <div class="col-xl-3">
                           Descargado por
                        </div>
                        <div class="col-xl-9">
                            <input type="text" value="{{$ticket->descargado_por}}" name="descargado_por" class="form-control" style="width: 60%;" required>
                        </div>
                        <div class="col-xl-3">
                           Preparado por
                        </div>
                        <div class="col-xl-9">
                            <input type="text" value="{{$ticket->preparado_por}}" name="preparado_por" class="form-control" style="width: 60%;" required>
                        </div>
                        <div class="col-xl-3">
                           Fecha de entrega
                        </div>
                        <div class="col-xl-9">
                            <input type="date" name="fecha_entrega" value="{{$ticket->fecha_entrega}}" class="form-control"  style="width: 60%;" required>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="id_bol" value="{{$boleta->id}}">

                    {{-- <div class="card-header"> --}}
                        <div class="card-toolbar" style="text-align: right;">
                            <button class="btn btn-primary" type="submit" style="margin-right: 7%;">
                                <i class="flaticon2-gear"></i>Terminar Pesaje
                            </button>
                        </div>
                        {{-- @include('workflow::private.terminar_pesaje') --}}
                    {{-- </div> --}}
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">

    function otroEstadoTicket(id){
        if(id == 'otro'){
          document.getElementById('tipo_pro_ticket').style.display = "block";
        }else{
          document.getElementById('tipo_pro_ticket').style.display = "none";
        }
    }

    function calcularNeto(){

        var peso_bruto = document.getElementById('peso_id_bruto').value;
        var peso_interno = document.getElementById('peso_id_interno').value;
        var peso_cliente = document.getElementById('peso_id_cliente').value;
        if(peso_interno != 0){
            peso_neto = Number.parseInt(peso_bruto)-Number.parseInt(peso_interno);
            peso_total = Number.parseInt(peso_neto)-Number.parseInt(peso_cliente);
            document.getElementById('peso_id_neto').value = peso_neto;
            document.getElementById('data_afoec').innerHTML = '';

            if(peso_total == 0){
              document.getElementById('div_calidad_peso').style.display = "none";
            }else{
              if(peso_total > 0){
                document.getElementById('data_afoec').innerHTML = 'Peso a favor: '+peso_total+'KG';
              }else{
                document.getElementById('data_afoec').innerHTML = 'Peso en contra: '+peso_total+'KG';
              }
              document.getElementById('div_calidad_peso').style.display = "block";
            }
        }

    }

    function EditarNGuiaDNContenedor(){
        var despacho = document.getElementById('id_text_despacho').value;
        var contenedor = document.getElementById('id_text_contenedor').value;
        var boletas_id = document.getElementById('boletas_hidden_id').value;

        const data = new FormData();
        data.append("_token", $("meta[name='csrf-token']").attr("content"));
        data.append("despacho",despacho);
        data.append("contenedor",contenedor);
        data.append("boletas_id",boletas_id);

        $.ajax({
                url: '{{ asset('workflow/edit-datos-ticket/') }}',
                type: 'post',
                dataType: 'json',
                data: data,
                processData: false,
                contentType: false,
                success: function(data, status)
                {
                    console.log(data['boleta']); 
                }
            });

    }

</script>
