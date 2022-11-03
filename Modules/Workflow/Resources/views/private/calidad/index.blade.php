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
						<h3 class="card-label">Control Calidad Boleta N°{{$boleta->codigo}} | Ticket N°{{$boleta->ticket->first()->id}}</h3>
					</div>
					<div class="card-toolbar">
                    <a href="{{asset('workflow/pesajes')}}" class="btn btn-sm btn-primary font-weight-bold">Volver a Solicitudes</a>
					</div>
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
                                    : {{ $boleta->n_guia_despacho }}
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
                                    : {{ $boleta->n_contenedor }}
                                </div>
                            </div>
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
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $count_producto }}</td>
                            @if ($producto->Residuos_id != null)
                                <td>{{ $producto->residuos->nombre }}</td>
                            @else
                                @if($producto->grupos_id != null)
                                    <td>{{$producto->grupo->nombre}}, {{$producto->clasificacion->nombre}}</td> 
                                @else
                                    <td>{{$producto->nombre}}</td> 
                                @endif
                            @endif
                            <td>
                                {{ $producto->peso_bruto }}
                            </td>
                            <td>
                                {{ $producto->peso_interno }}
                            </td>
                            <td>
                               {{ $producto->peso_neto }}
                            </td>
                        </tr>
                        <?php 
                            $total_peso_bruto = $total_peso_bruto+$producto->peso_bruto;
                            $total_peso_interno  = $total_peso_interno+$producto->peso_interno;
                            $total_peso_neto = $total_peso_neto+$producto->peso_neto;
                            $count_producto = $count_producto+1;
                            $diferencia_cliente = $producto->peso+$diferencia_cliente;
                        ?>
                    @endforeach
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
                        </tr>
                </tbody>
            </table>
        </div>
        
        <div class="card-header">
            
                    <?php 
                        $diferencia = $total_peso_neto-$diferencia_cliente;
                    ?>
                @if($boleta->calidad->count() != 0)
                    <div class="card card-custom card-fit">
                        <div  id="div_calidad_peso">
                            <div class="row"> 
                                <div class="col-xl-6">
                                    <div class="form-group">
                                         <label>Fotos</label><br>
                                        <img src="{{ asset('storage/'.$boleta->calidad->where('sl_tipo_imagen_id',2)->first()->archivo) }}" style="width: 50%;">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                         <label>Observaciones (opcional)</label>
                                        {!!Form::textarea('observaciones',$boleta->calidad->where('sl_tipo_imagen_id',2)->first()->observacion,['class'=>"form-control",'rows'=>'2'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card card-custom card-fit card-border">
                    <div class="row">    
                        <div class="col-xl-7">
                            DIFERENCIA CON PESAJE INFORMADO POR CLIENTE: <b>Total Cliente {{$diferencia_cliente}} Kg</b>
                        </div>
                        <div class="col-xl-2">
                            <input type="number" name="diferencia_peso_kg" style="width: 60%;" readonly value="{{$diferencia}}"> KG
                        </div>
                        <div class="col-xl-3" style="text-align:left;">
                            @if($diferencia > 0)
                                <input type="radio" name="diferencia_peso" value="1" checked readonly>
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2" readonly>
                                <label>Contra</label><br>
                            @elseif($diferencia < 0)
                                <input type="radio" name="diferencia_peso" value="1" readonly>
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2" checked readonly>
                                <label>Contra</label><br>
                            @elseif($diferencia == 0)
                                <input type="radio" name="diferencia_peso" value="1" readonly>
                                <label>Favor</label>
                                <input type="radio" name="diferencia_peso" value="2" readonly>
                                <label>Contra</label><br>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <br>
                            TIPO CARGA
                        </div>
                        <div class="col-xl-9">
                            <br>
                            @foreach($tipo_producto as $tipo)
                                {{ $tipo->nombre }}
                                @if($boleta->ticket->first()->ticket_estado->where('tipo_producto_id',$tipo->id)->count() != 0)
                                    <input type="number" style="width: 10%;" value="{{$boleta->ticket->first()->ticket_estado->where('tipo_producto_id',$tipo->id)->first()->cantidad}}" readonly>
                                @else
                                    <input type="number" style="width: 10%;" readonly>
                                @endif
                            @endforeach
                            Otro @if($boleta->ticket->first()->ticket_estado->where('tipo_producto_id',null)->count() != 0)
                                    <input type="number" style="width: 10%;" value="{{$boleta->ticket->first()->ticket_estado->where('tipo_producto_id',null)->first()->cantidad}}" readonly>
                                @else
                                    <input type="number" style="width: 10%;" readonly>
                                @endif
                        </div>
                    </div>
                    @if($boleta->ticket->first()->ticket_estado->where('tipo_producto_id',null)->count() != 0)
                    <div class="row">                      
                        <div class="col-xl-3">
                            <br>
                            OTRO ESTADO
                        </div>
                        <div class="col-xl-9">
                             <br>
                            <input type="text" class="form-control" value="{{$boleta->ticket->first()->ticket_estado->where('tipo_producto_id',null)->first()->otro_estado}}" readonly>
                        </div>
                    </div>
                    @endif
                    <br>
                    <div class="row">                      
                        <div class="col-xl-3">
                             <br>
                            OBSERVACIONES
                        </div>
                        <div class="col-xl-9">
                             <br>
                            <textarea class="form-control" rows="2" readonly>{{$boleta->ticket->first()->observaciones}}</textarea> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">    
                        <div class="col-xl-3">
                           Descargado por
                        </div>
                        <div class="col-xl-9">
                            <input type="text" value="{{$boleta->ticket->first()->descargado_por}}" class="form-control" style="width: 60%;" readonly>
                        </div>
                        <div class="col-xl-3">
                           Preparado por
                        </div>
                        <div class="col-xl-9">
                            <input type="text" value="{{$boleta->ticket->first()->preparado_por}}" class="form-control" style="width: 60%;" readonly>
                        </div>
                        <div class="col-xl-3">
                           Fecha de entrega
                        </div>
                        <div class="col-xl-9">
                            <input type="date" value="{{$boleta->ticket->first()->fecha_entrega}}" class="form-control"  style="width: 60%;" readonly>
                        </div>
                    </div>
                    <hr>
                    {!! Form::open(['url' => 'workflow/control-calidad','files'=>true, 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-xl-12">
                                <h5>Control de Calidad</h5>
                            </div>   
                        </div>
                        <div class="row"> 
                            <div class="col-xl-6">
                                <div class="form-group">
                                     <label>Fotos</label><br>
                                    <input type="file" name="foto" accept="image/*"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                     <label>Observaciones (opcional)</label>
                                    {!!Form::textarea('observaciones',null,['class'=>"form-control",'rows'=>'2','required'])!!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="id_bol" value="{{$boleta->id}}">
                        <div class="card-toolbar" style="text-align: right;">
                            <button class="btn btn-primary" type="submit" style="margin-right: 7%;">
                                <i class="flaticon2-gear"></i>Terminar Control de Calidad
                            </button>
                        </div>
                    {!!Form::close()!!}
                </div>
        </div>
    </div>
</div>
@endsection
