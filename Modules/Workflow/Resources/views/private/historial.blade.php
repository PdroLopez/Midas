@extends('layouts.backend.master')
@section('content')

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Gestor</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Solicitudes</a>
                </li>
            </ul>
        </div>

    </div>
</div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="d-flex flex-row">
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                    <div class="card card-custom card-stretch">
                        </div>
                    </div>
                </div>
                <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">

                            <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                                <div class="input-icon">
                                    <h4>HISTORIAL DE RETIROS</h4>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body table-responsive">
                            <!--begin::Items-->
                            <table class="table table-bordered table-checkable">
                            	<thead>
	                            	<tr>
	                            		<th>ID</th>
	                            		<th>Nombre Cliente</th>
	                            		<th>Solicitado Por</th>
	                            		<th>Estado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Retiro</th>
                                        <th>Ticket</th>
                                        <th>Fecha Pesaje</th>
	                            		<th>Total Neto</th>
	                            		<th>Acciones</th>
	                            	</tr>
                            	</thead>
                            	<tbody>
                                    @foreach($boletas as $boleta)
                                    <?php 
                                        $numero = (string)$boleta->total;
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
                                			<th>{{ $boleta->id }}</th>
                                			<th>
                                                @if($boleta->empresas_id != null)
                                                    {{ $boleta->empresas->nombre }}
                                                @else
                                                    @if($boleta->user)
                                                        {{ $boleta->user->name }} {{ $boleta->user->apellido }}
                                                    @else
                                                        {{ $boleta->nombre}}
                                                    @endif
                                                @endif
                                            </th>
                                			<th>
                                                @if($boleta->creador != null)
                                                    {{$boleta->creador->name}} {{ $boleta->creador->apellido }}
                                                @else
                                                    Sin Creador
                                                @endif
                                            </th>
                                			<th>
                                                @if($boleta->estado)
                                                    {{ $boleta->estado->nombre }}
                                                @else
                                                    Sin estado
                                                @endif
                                            </th>
                                			<th>{{ $boleta->created_at }}</th>
                                            <th>
                                                @if($boleta->empresas_id != null)
                                                    @if($boleta->tipo_servicio_id != null)
                                                        Servicio: {{$boleta->tipo_servicio->nombre}}<br>
                                                    @endif
                                                    Jornada Estimada:
                                                    @if($boleta->horarios_dias_id != null)
                                                        {{$boleta->dia->nombre}}
                                                    @else
                                                        Por definir 
                                                    @endif
                                                    desde {{$boleta->desde}} hasta {{$boleta->hasta}}.
                                                @else
                                                    @if($boleta->retiro_propio == null)
                                                        @if($boleta->horarios_id && $boleta->horarios_dias_id)
                                                        {{ $boleta->dia->nombre }}
                                                         en {{ $boleta->horario->hora }}HRS ({{ $boleta->horario->nombre }})
                                                         @endif
                                                     @else
                                                        @if($boleta->retiro_propio == 1)
                                                            Retiro de la empresa solicitante
                                                        @else
                                                            Midas realizara el retiro
                                                        @endif
                                                     @endif
                                                 @endif
                                                 @if($boleta->venta->count() != 0)
                                                    Incluye {{$boleta->venta->first()->cantidad}} {{$boleta->venta->first()->producto->nombre}}.
                                                 @endif
                                            </th>
                                            <th>
                                                @if($boleta->ticket->count() != 0)
                                                    N° Ticket : {{ $boleta->ticket->first()->id }}<br>
                                                    N° Guía Despacho : {{ $boleta->n_guia_despacho}}
                                                @else
                                                    Sin Ticket
                                                @endif
                                            </th>
                                            <th>
                                                @if($boleta->ticket->count() != 0)
                                                    {{ $boleta->ticket->first()->fecha_entrega }}
                                                @else
                                                    Sin Ticket
                                                @endif
                                            </th>
                                            <th>
                                                <?php $peso_neto = 0; ?>
                                                @foreach ($boleta->solicitudes as $element)
                                                    <?php $peso_neto = $peso_neto+$element->solicitud->peso_neto;?>
                                                @endforeach
                                                {{$peso_neto}} Kg
                                            </th>
                                			<th>
                                                <div class="dropdown dropdown-inline mr-2">
                                                    <button type="button" class="btn btn-light-danger font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones</button>
                                                    <!--begin::Dropdown Menu-->
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                        <ul class="nav flex-column nav-hover">
                                                            <li class="nav-item">
                                                                 <a href="{{asset('workflow/solicitud/view/seguimiento/'.$boleta->id)}}" class="dropdown-item">Seguimiento</a> 
                                                            </li>
                                                            
                                                            @if ($boleta->estado->id == 2)
                                                            <li class="nav-item">
                                                                <a href="{{ asset('workflow/descargar/'.$boleta->id) }}" class="dropdown-item" >Certificado</a>
                                                            </li>
                                                            @endif
                                                            @if ($boleta->estado->id == 29)
                                                             <li class="nav-item">
                                                                <a href="{{ asset('workflow/control-calidad/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text">Control Calidad</span>
                                                                </a>
                                                            </li>
                                                            @endif
                                                            @if($boleta->ticket->count() != 0)
                                                            <li class="nav-item">
                                                                <a href="{{ asset('workflow/descargar/ticket/'.$boleta->id) }}" class="dropdown-item" >Ticket Pesaje</a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                 <a href="{{asset('workflow/pesaje/edit-ticket/'.$boleta->id)}}" class="dropdown-item">Editar</a> 
                                                            </li> --}}
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <!--end::Dropdown Menu-->
                                                </div>
                                			    
                                			</th>
                                		</tr>
                                    @endforeach
                            	</tbody>
                            </table>
                            <!--end::Items-->
                            
                            {{ $boletas->links() }}
                        </div>
                        <!--end::Body-->
                    </div>

            </div>

        </div>
        <!--end::Container-->
    </div>
@endsection
