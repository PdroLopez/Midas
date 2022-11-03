@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Inicio</h5>
            </div>
        </div>

    </div>
</div>
 {{-- <div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Programación</h3>
                <div class="ml-10">@include('backend::private.programacion.create')</div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Buscar..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programacion as $programaciones)
                            <tr>
                                <td>{{ $programaciones->id }}</td>
                                <td>{{ $programaciones->nombre }}</td>

                                <td>
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{ $programaciones->id }}">Editar</a>
                                    @include('backend::private.programacion.destroy')
                                </td>
                                @include('backend::private.programacion.edit')
                            </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div> --}}

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

                    {{--   <div class="card-body px-5 text-center">

                        <div class="btn-group">

                            <button class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
                                        <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
                                    </g>
                                </svg>

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

                        {{----}}
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
                                    <input type="text" class="form-control" placeholder="Buscar..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
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
                                    <th>Chofer</th>
                                    <th>Estado</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Productos</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boleta as $boletas)
                              
                                    <tr>
                                        <th>{{ $boletas->id }}</th>
                                        <th>{{ $boletas->chofer->name }}</th>
                                        <th>{{ $boletas->estado->nombre }}</th>
                                        <th>{{ $boletas->fecha_hora }}</th>
                                        @foreach ($boletas->solicitudes as  $productos)
                                            <th>{{ $productos->solicitud->nombre }}</th>

                                            
                                        @endforeach
                                        
                                        {{--  --}}
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Items-->
                  

                    </div>
                    <!--end::Body-->
                </div>

        </div>

    </div>
    <!--end::Container-->
</div>
@endsection
