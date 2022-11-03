@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Gestor</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Resumen SMS</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Resumen SMS</h3>
                <div class="ml-10"></div>
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
            {!!Form::open(['url' => 'backend/private/buscar-date-sms', 'method' => 'POST','files'=>true])!!}
                <div class="row">
                    <div class="col-lg-4">
                        <label>Desde</label>
                        <input type="date" class="form-control" name="desde" value="{{Session::get('date_desde')}}" max="{{$now}}">
                    </div>
                    <div class="col-lg-4">
                        <label>Hasta</label>
                        <input type="date" class="form-control" name="hasta" value="{{Session::get('date_hasta')}}" max="{{$now}}">

                    </div>
                    <div class="col-lg-4" style="padding-block: 25px;">
                        <label></label>
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            {!!Form::close()!!}
            <div class="card-body table-responsive">
                <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Teléfono</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resumen_sms as $sms)
                            <tr>
                                <td>{{ $sms->id }}</td>
                                <td>{{ $sms->telefono }}</td>
                                <td>{{ $sms->mensaje }}</td>
                                <td>{{ $sms->created_at }}</td>
                                <td>{{ $sms->estado }}</td>
                                <td>@include('backend::private.resumen_sms.destroy')</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



