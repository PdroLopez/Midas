@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Reportes</h5>
            </div>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><h4>Tipo de Reporte</h4></label>
                            {!!Form::select('reporte',['1'=>'Retiros por empresa','2'=>'Retiros particulares','3'=>'Ventas'],null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required', 'onchange' => 'elegir_reporte(this.value)','id'=>'tipo_reporte_id'])!!}
                        </div>
                    </div>
                </div>
                <hr> 
                <div class="row" id="div_por_empresa" style="display: none">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><h5>Reportes Retiros de Empresas</h5></label>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mes</label>
                                    {!!Form::select('',['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'],null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required', 'onchange' => 'elegir_opcion_reporte()','id'=>'opcion1_mes_id'])!!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Año</label>
                                    <select class="form-control" onchange="elegir_opcion_reporte()" id="opcion1_anio_id">
                                        <option value="">Seleccionar</option>
                                        @for ($i = $now_fecha->format('Y'); $i > 1944; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Empresa</label>
                                    {!!Form::select('',$empresas,null,['class'=>"form-control", 'placeholder'=>"Seleccionar", 'onchange' => 'elegir_opcion_reporte()', 'id'=>'opcion1_empresa_id'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12" id="div_tabla_1">
                                <table class="table table-responsive" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Categoría</th>
                                            <th>Solicitado Por</th>
                                            <th>Estado</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Retiro</th>
                                            <th>Creado por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($boletas_em as $boleta_em)
                                            <tr>
                                                <th>{{ $boleta_em->id }}</th>
                                                <th>
                                                    @if($boleta_em->empresas_id != null)
                                                    <span class="badge badge-secondary">Industrial</span>

                                                    @else
                                                    <span class="badge badge-primary">Particular</span>

                                                    @endif

                                                </th>
                                                <th>
                                                    @if($boleta_em->empresas_id != null)
                                                        {{ $boleta_em->empresas->nombre }}
                                                    @else
                                                        @if($boleta_em->user)
                                                            {{ $boleta_em->user->name }}
                                                        @else
                                                            Sin nombre
                                                        @endif
                                                    @endif
                                                </th>
                                                <th>
                                                    @if($boleta_em->estado)
                                                        {{ $boleta_em->estado->nombre }}
                                                    @else
                                                        Sin estado
                                                    @endif
                                                </th>

                                                <th>{{ $boleta_em->created_at }}</th>
                                                <th>
                                                    @if($boleta_em->retiro_propio == null)
                                                        @if($boleta_em->horarios_id && $boleta_em->horarios_dias_id)
                                                        {{ $boleta_em->dia->nombre }}
                                                         en {{ $boleta_em->horario->hora }}HRS ({{ $boleta_em->horario->nombre }})
                                                         @endif
                                                     @else
                                                        @if($boleta_em->retiro_propio == 1)
                                                            Retiro de la empresa solicitante
                                                        @else
                                                            Midas realizara el retiro
                                                        @endif
                                                     @endif
                                                </th>
                                                <th>
                                                    @if($boleta_em->creador_id != null)
                                                        {{$boleta_em->creador->name}}
                                                    @else
                                                        Sin Creador
                                                    @endif
                                                </th>
                                                <th>
                                                    <div class="dropdown dropdown-inline mr-2">
                                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones</button>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav flex-column nav-hover">
                                                                <li class="nav-item">
                                                                    <a href="{{ asset('workflow/certificados/pdf/'.$boleta_em->id) }}" class="nav-link">
                                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                                        <span class="nav-text">Certificados</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="div_particular" style="display: none">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><h5>Reportes Retiros Particulares</h5></label>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mes</label>
                                    {!!Form::select('',['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'],null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required', 'onchange' => 'elegir_opcion_reporte()','id'=>'opcion2_mes_id'])!!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Año</label>
                                    <select class="form-control" onchange="elegir_opcion_reporte()" id="opcion2_anio_id">
                                        <option value="">Seleccionar</option>
                                        @for ($i = $now_fecha->format('Y'); $i > 1944; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12" id="div_tabla_2">
                                <table class="table table-responsive" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Categoría</th>
                                            <th>Solicitado Por</th>
                                            <th>Estado</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Retiro</th>
                                            <th>Creado por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($boletas_pa as $boleta_pa)
                                            <tr>
                                                <th>{{ $boleta_pa->id }}</th>
                                                <th>
                                                    @if($boleta_pa->empresas_id != null)
                                                    <span class="badge badge-secondary">Industrial</span>

                                                    @else
                                                    <span class="badge badge-primary">Particular</span>

                                                    @endif

                                                </th>
                                                <th>
                                                    @if($boleta_pa->empresas_id != null)
                                                        {{ $boleta_pa->empresas->nombre }}
                                                    @else
                                                        @if($boleta_pa->user)
                                                            {{ $boleta_pa->user->name }}
                                                        @else
                                                            Sin nombre
                                                        @endif
                                                    @endif
                                                </th>
                                                <th>
                                                    @if($boleta_pa->estado)
                                                        {{ $boleta_pa->estado->nombre }}
                                                    @else
                                                        Sin estado
                                                    @endif
                                                </th>

                                                <th>{{ $boleta_pa->created_at }}</th>
                                                <th>
                                                    @if($boleta_pa->retiro_propio == null)
                                                        @if($boleta_pa->horarios_id && $boleta_pa->horarios_dias_id)
                                                        {{ $boleta_pa->dia->nombre }}
                                                         en {{ $boleta_pa->horario->hora }}HRS ({{ $boleta_pa->horario->nombre }})
                                                         @endif
                                                     @else
                                                        @if($boleta_pa->retiro_propio == 1)
                                                            Retiro de la empresa solicitante
                                                        @else
                                                            Midas realizara el retiro
                                                        @endif
                                                     @endif
                                                </th>
                                                <th>
                                                    @if($boleta_pa->creador_id != null)
                                                        {{$boleta_pa->creador->name}}
                                                    @else
                                                        Sin Creador
                                                    @endif
                                                </th>
                                                <th>
                                                    <div class="dropdown dropdown-inline mr-2">
                                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones</button>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav flex-column nav-hover">
                                                                <li class="nav-item">
                                                                    <a href="{{ asset('workflow/certificados/pdf/'.$boleta_pa->id) }}" class="nav-link">
                                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                                        <span class="nav-text">Certificados</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="div_ventas" style="display: none">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><h5>Reportes de Ventas(Kits)</h5></label>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mes</label>
                                    {!!Form::select('',['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'],null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required', 'onchange' => 'elegir_opcion_reporte()','id'=>'opcion3_mes_id'])!!}
                                </div>
                            </div>
                             <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Desde</label>
                                        {!!Form::date('fecha_inicio',$now_fecha->format('Y-m-d'),['class'=>"form-control", 'placeholder'=>"Seleccionar", 'onchange' => 'elegir_opcion_reporte()','id'=>'opcion3_fecha_inicio_id'])!!}
                                    </div>
                                    <div class="col-md-6">
                                        <label>Hasta</label>
                                        {!!Form::date('fecha_termino',$now_fecha->format('Y-m-d'),['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'onchange' => 'elegir_opcion_reporte()','id'=>'opcion3_fecha_termino_id'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12" id="div_tabla_3">
                                <table class="table table-responsive" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Total</th>
                                            <th>Comprado Por</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaccion as $transa)
                                        <?php
                                            $numero = (string)$transa->total;
                                            $puntos = floor((strlen($numero)-1)/3);
                                            $tmp = "";
                                            $pos = 1;
                                            for($i=strlen($numero)-1; $i>=0; $i--){
                                                $tmp = $tmp.substr($numero, $i, 1);
                                                if($pos%3==0 && $pos!=strlen($numero))
                                                $tmp = $tmp.".";
                                                $pos = $pos + 1;
                                            }
                                            $otraOnda = "$ ".strrev($tmp);
                                        ?>
                                        <tr>
                                            <td>#{{ $transa->id }}</td>
                                            <td>{!! $otraOnda !!}</td>
                                            <td>
                                                @if($transa->user != null)
                                                {{ $transa->user->name }}
                                                @endif
                                            </td>
                                            <td>
                                               @if($transa->estatus != null)
                                                    {{ $transa->estatus->nombre }}
                                                @else
                                                    <p>Sin Estado</p>
                                                @endif


                                            </td>
                                            <td>
                                                <a class="btn btn-info" data-toggle="modal" data-target="#detalle">Certificados</a>

                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6" id="div_rango_fechas" style="display: none">
                        <div class="row">
                            <div class="col-md-6">
                                {!!Form::date('fecha_inicio',$now_fecha->format('Y-m-d'),['class'=>"form-control", 'placeholder'=>"Seleccionar", 'onchange' => 'fechas_rango()','id'=>'fecha_inicio_id'])!!}
                            </div>
                            <div class="col-md-6">
                                {!!Form::date('fecha_termino',$now_fecha->format('Y-m-d'),['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'onchange' => 'fechas_rango()','id'=>'fecha_termino_id'])!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    function elegir_reporte(id){
        if(id == 1){//Retiros Empresa
            document.getElementById('div_por_empresa').style.display = "block";
            document.getElementById('div_particular').style.display = "none";
            document.getElementById('div_ventas').style.display = "none";
        }else if(id == 2){//Particular
            document.getElementById('div_particular').style.display = "block";
            document.getElementById('div_por_empresa').style.display = "none";
            document.getElementById('div_ventas').style.display = "none";

        }else if(id == 3){//ventas
            document.getElementById('div_ventas').style.display = "block";
            document.getElementById('div_por_empresa').style.display = "none";
            document.getElementById('div_particular').style.display = "none";
        }else{
            document.getElementById('div_ventas').style.display = "none";
            document.getElementById('div_por_empresa').style.display = "none";
            document.getElementById('div_particular').style.display = "none";
        }
    }

    function elegir_opcion_reporte(){

        {{-- {{ asset('private/opcion-elegida/') }} --}}
        // if(id == 1 || id== 2 || id== 3 || id== 4){
        //     $.get(''+id+"",function(response, regiones){
        //         $("#opcion_elegida_id").empty();
        //         $("#opcion_elegida_id").append(`<option value ="">Selecciona`);
        //         response.forEach(element => {
        //             $("#opcion_elegida_id").append(`<option value=${element.id}> ${element.nombre} </option>`);
        //         });
        //     });
        // }else if(id== 5 || id== 6){
        //     document.getElementById('div_rango_fechas').style.display = "block";
        //     document.getElementById('div_select').style.display = "none";
            
        // }
    }
</script>