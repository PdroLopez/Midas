@extends('layouts.backend.master')
@section('content')
{{-- @include('tienda::admin.index') --}}
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Gestor</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Orden de Trabajos</a>
                        </li>
                    </ul>

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>

        </div>
    </div>
    <style type="text/css">
        .datatable-pager.datatable-paging-loaded{
            display: none !important;
        }
    </style>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Inbox-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body px-5 text-center">

                            <div class="btn-group">

                                <button style="width: 100%" class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{-- <img src="{{ asset('storage/temporal/WEQGXjOtrmLAiGAaqo0FD4SIhrj9SbfPaOmEEb1m/7vKGmgAt82pxAGfNruc1c1fe6Zj84rSQUXrwF8uD.jpg')}}"></img> --}}
{{--                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            				<polygon points="0 0 24 0 24 24 0 24"></polygon>
                            				<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            				<rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
                            				<rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
                            			</g>
                            		</svg> --}}

                                     Nueva Solicitud
                                </button>
                                <div class="dropdown-menu" style="">
                                    @if(Auth::user()->roles_id == 16 || Auth::user()->roles_id == 15)
									   <a class="dropdown-item" href="{{asset('/workflow/solicitud/create/industrial')}}">Retiro Industrial</a>
                                    @else
                                        <a class="dropdown-item" href="{{asset('/workflow/solicitud/create/particular')}}">Retiro Particular</a>
                                       <a class="dropdown-item" href="{{asset('/workflow/solicitud/create/industrial')}}">Retiro Industrial</a>
                                    @endif
								</div>
                            </div>
                            <p></p>
                            <!--begin::Navigations-->
                            <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="{{ asset('workflow/') }}" class="navi-link active">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Solicitudes</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-success font-weight-bolder">
                                                @if(count($total) != null)
                                                    {{ count($total) }}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                        </span>
                                    </a>
                                </div>

                                <div class="navi-item my-2">
                                    <a href="{{ asset('workflow/datos-aceptados') }}" class="navi-link">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Aceptados</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-warning font-weight-bolder">{{ count($aceptado) }}</span>
                                        </span>
                                    </a>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="{{ asset('workflow/datos-proceso') }}" class="navi-link">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">En proceso</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-warning font-weight-bolder">{{ count($enproceso) }}</span>
                                        </span>
                                    </a>
                                </div>
                                <!-- aceptados -->
                                
                                <!-- cancelado -->
                                <div class="navi-item my-2">
                                    <a href="{{ asset('workflow/datos-cancelados') }}" class="navi-link">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Canceladas</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-warning font-weight-bolder">{{ count($cancelado) }}</span>
                                        </span>
                                    </a>
                                </div>

                                <div class="navi-item my-2">
                                    <a href="{{ asset('workflow/datos-terminados') }}" class="navi-link">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Terminadas</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-warning font-weight-bolder">{{ count($terminado) }}</span>
                                        </span>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header row-marginless align-items-center flex-wrap py-5 h-auto">
                            
                        <form class="row" action="{{ asset('workflow/filtrar-solicitudes') }}" method="post" files="true" enctype="multipart/form-data">
                            @csrf

                            {{-- <div class="col-xl-3">
                                <div class="form-check form-check-inline">
                                    <input name="industriales" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Industriales</label>
                                </div>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input name="particulares" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2">
                                    <label class="form-check-label" for="inlineCheckbox2">Particulares</label>
                                </div>
                            </div> --}}
                            <div class="col-xl-5">
                                <select name="contratista" class="form-control form-control">
                                    <option>Empresa</option>
                                    @foreach($contratista as $contr)
                                        <option value="{{$contr->id}}">{{$contr->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-5">
                                <select name="estados" class="form-control form-control">
                                    <option>Estados</option>
                                    @foreach($estados as $esta)
                                        <option value="{{$esta->id}}">{{$esta->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2">
                                <button class="btn btn-primary font-weight-bold" type="submit">Filtrar</button>
                            </div>
                        </form>
                        {{-- <div>
                            <div class="col-xl-12">
                                <a href="{{route('descargar.excel.solicitud')}}" class="btn btn-info font-weight-bold">Descargar Excel</a>
                            </div>
                        </div> --}}
                        </div>
{{--                         <div > --}}
                           {{--  <div class="col-xxl-12 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Buscar..." id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div> --}}

                        {{-- </div> --}}

                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body table-responsive">
                            <!--begin::Items-->
                            <table class="table table-bordered table-checkable">
                            	<thead>
	                            	<tr>
                                        <th>ID</th>
                                        <th>Categoría</th>
	                            		{{-- <th>Nombre Cliente</th> --}}
	                            		<th>Solicitado Por</th>
	                            		<th>Estado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Retiro</th>
                                        <th>Creado por</th>
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
                                                <span class="badge badge-secondary">Industrial</span>

                                                @else
                                                <span class="badge badge-primary">Particular</span>

                                                @endif

                                            </th>
                                			{{-- <th>
                                                @if($boleta->user)
                                                    {{ $boleta->user->name }}
                                                @else
                                                    @if($boleta->empresas_id == null)
                                                        {{ $boleta->empresas->emp_usuario->first()->empresa->nombre }}
                                                    @else
                                                        Sin nombre
                                                    @endif
                                                @endif
                                            </th> --}}
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
                                                @if($boleta->creador_id != null)
                                                    {{$boleta->creador->name}}
                                                @else
                                                    Sin Creador
                                                @endif
                                            </th>
                                			<th>
                                				<div class="dropdown dropdown-inline mr-2">
    												<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    												Acciones</button>
    												<!--begin::Dropdown Menu-->
    												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
    													<ul class="nav flex-column nav-hover">
    														
    														{{-- <li class="nav-item">
    															<a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#edit{{$boleta->id}}">Ver Detalles</a>
                                                            </li> --}}
                                                            @if ($boleta->estado->id == 24)
                                                            <li style="background-color: #ccc" class="nav-item">
                                                                <a href="{{ asset('workflow/aprobacion/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text">{{$boleta->estado->id}} / Enviar a aprobación</span>
                                                                </a>
                                                            </li>
                                                            @elseif ($boleta->estado->id == 25 || $boleta->estado->id == 1)

                                                            <li class="nav-item">
                                                                <a href="{{ asset('workflow/programacion/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text"> Comenzar</span>
                                                                </a>
                                                            </li>



                                                            @endif


                                                           <li class="nav-item">
                                                                <a href="{{ asset('workflow/por-despacho/'.$boleta->id) }}" class="nav-link">
                                                                    <span class="nav-text">Por despacho</span>
                                                                </a>
                                                            </li>
    														<li class="nav-item">
    															<a href="{{ asset('workflow/cancelar/'.$boleta->id) }}" class="nav-link">
    																<span class="nav-text">Cancelar</span>
    															</a>
    														</li>
                                                            @if ($boleta->estado->id == 29)
    														<li class="nav-item">
    															<a href="{{ asset('workflow/finalizar/'.$boleta->id) }}" class="nav-link">
    																<span class="nav-text">Finalizar</span>
    															</a>
    														</li>
                                                            @endif
                                                            <li class="nav-item">
    															<a href="{{asset('workflow/solicitud/view/seguimiento/'.$boleta->id)}}" class="nav-link">
    																<span class="nav-text">Seguimiento</span>
    															</a>
    														</li>
                                                            {{-- <li class="nav-item">
                                                                @if($boleta->empresas_id != null)
                                                                    <a href="{{asset('workflow/solicitud/editar/industrial/'.$boleta->id)}}" class="nav-link">
                                                                        <span class="nav-text">Editar</span>
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('workflow/solicitud/editar/particular/'.$boleta->id)}}" class="nav-link">
                                                                        <span class="nav-text">Editar</span>
                                                                    </a>
                                                                @endif
                                                            </li> --}}
    													</ul>
    												</div>
    												<!--end::Dropdown Menu-->
    											</div>
                                			</th>
                                            {{-- @include('workflow::private.modal.logistica.edit') --}}
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
</div>
    <!--end::Entry-->
    {{-- orueba --}}
@endsection
