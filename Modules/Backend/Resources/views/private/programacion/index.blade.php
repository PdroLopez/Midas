@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Gestor</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Programación</a>
                </li>
            </ul>
        </div>

    </div>
</div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Inbox-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                    <!--begin::Card-->
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
                                <h3 class="card-label">Programación</h3>
{{--                                 <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Buscar..."/>
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div> --}}
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
                                        <th>Fecha Retiro</th>
	                            		<th>Horario</th>
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
                                                @if($boleta->empresas_id != null)
                                                    {{ $boleta->empresas->nombre }}
                                                @else
                                                    @if($boleta->user)
                                                        {{ $boleta->user->name }}
                                                    @else
                                                        Sin nombre
                                                    @endif
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
                                			<th>@if($boleta->fecha_hora != null)
                                                    {{ $boleta->fecha_hora }}
                                                @else
                                                    Sin Fecha
                                                @endif   
                                            </th>
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
                                				<div class="dropdown dropdown-inline mr-2">
    												<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    												Acciones</button>
    												<!--begin::Dropdown Menu-->
    												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
    													<ul class="nav flex-column nav-hover">
                                                            @if ($boleta->estado->id == 28 || $boleta->estado->id == 27 || $boleta->estado->id == 9)
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/generar/qr/bol/'.$boleta->id) }}" class="nav-link" target="_blank">
                                                                    <span class="nav-text">QR Retiro</span>
                                                                </a>
                                                            </li>
                                                            @endif
                                                            @if ($boleta->estado->id == 26 || $boleta->estado->id == 27)

                                                            <li class="nav-item">
                                                                <a href="{{ asset('workflow/programacion/'.$boleta->id) }}" data-toggle="modal" data-target="#Programar{{$boleta->id}}" class="nav-link">
                                                                    <span class="nav-text">Programar</span>
                                                                </a>
                                                            </li>
                                                           @endif 

                                                           @if ($boleta->estado->id == 27 )
                                                           

                                                           <li class="nav-item">
                                                               <a href="{{ asset('workflow/en-camion/'.$boleta->id) }}" onclick="return confirm('Esta seguro de querer cambiar el estado a: En camino?');"
                                                                class="nav-link">
                                                                   <span class="nav-text">En camino</span>
                                                               </a>
                                                           </li>
                                                          @endif 
                                                          @if ($boleta->estado->id == 21 )
                                                           

                                                          <li class="nav-item">
                                                              <a href="{{ asset('workflow/en-planta/'.$boleta->id) }}" onclick="return confirm('Esta seguro de querer cambiar el estado a: En camino?');"
                                                               class="nav-link">
                                                                  <span class="nav-text">En planta</span>
                                                              </a>
                                                          </li>
                                                         @endif 


{{--     														<li class="nav-item">
    															<a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#edit{{$boleta->id}}">Ver Detalles</a>
                                                            </li> --}}
                                                            @if ($boleta->estado->id == 24)
                                                            <li style="background-color: #ccc" class="nav-item">
                                                                <a href="{{ asset('workflow/aprobacion/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text">{{$boleta->estado->id}} / Enviar a aprobación</span>
                                                                </a>
                                                            </li>
                                                            @elseif ($boleta->estado->id == 25)

                                                            <li class="nav-item">
                                                                <a href="{{ asset('workflow/programacion/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text"> Procesar</span>
                                                                </a>
                                                            </li>



                                                            @endif
                                                            
                                                            
                                                            {{-- <li class="nav-item">
                                                                <a href="{{ asset('workflow/por-despacho/'.$boleta->id) }}" class="nav-link">
                                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                                    <span class="nav-text">Por despacho</span>
                                                                </a>
                                                            </li> --}}
    														<li class="nav-item">
    															<a href="{{ asset('workflow/cancelar/'.$boleta->id) }}" class="nav-link">
    																<span class="nav-text">Cancelar</span>
    															</a>
    														</li>
    														<li class="nav-item">
    															<a href="{{ asset('workflow/finalizar/'.$boleta->id) }}" class="nav-link">
    																<span class="nav-text">Finalizar</span>
    															</a>
    														</li>
                                                            <li class="nav-item">
    															<a href="{{asset('workflow/solicitud/view/seguimiento/'.$boleta->id)}}" class="nav-link">
    																<span class="nav-text">Seguimiento</span>
    															</a>
    														</li>
                                                            @if ($boleta->estado->id == 26)
                                                             <li class="nav-item">
                                                                @if($boleta->empresas_id != null)
                                                                    <a href="{{asset('workflow/solicitud/editar/industrial/'.$boleta->id)}}" class="nav-link">
                                                                        <span class="nav-text">Editar</span>
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('workflow/solicitud/editar/particular/'.$boleta->id)}}" class="nav-link">
                                                                        <span class="nav-text">Editar</span>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                            @endif
    													</ul>
    												</div>
    												<!--end::Dropdown Menu-->
    											</div>
                                			</th>
                                            {{-- @include('workflow::private.modal.logistica.edit') --}}
                                            @include('workflow::private.create')

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