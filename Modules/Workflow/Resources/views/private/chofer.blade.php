@extends('workflow::layouts.backend.master')
@section('workflow::content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Choferes</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Orden de Trabajo</a>
                </li>
            </ul>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Camioneros
            </div>
           <div class="card-body table-responsive">
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patente Camión</th>
                            <th>Nombre</th>
                            <th>Rut</th>
                            <th>Revision técnica</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <th>XR-VT-33</th>
                            <th>Ramón Perez</th>
                            <th>10897456-8</th>
                            <th>Al dia</th>
                            <th>Libre</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp;&nbsp;Escoge una opción:</li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-copy"></i>
                                                    <span class="nav-text">Carga laboral</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                    <span class="nav-text">Recursos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>XR-VT-33</th>
                            <th>Ramón Perez</th>
                            <th>10897456-8</th>
                            <th>Al dia</th>
                            <th>Ocupado</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp;&nbsp;Escoge una opción:</li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-copy"></i>
                                                    <span class="nav-text">Carga laboral</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                    <span class="nav-text">Recursos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>XR-VT-33</th>
                            <th>Ramón Perez</th>
                            <th>10897456-8</th>
                            <th>Por hacer</th>
                            <th>Ocupado</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp;&nbsp;Escoge una opción:</li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-copy"></i>
                                                    <span class="nav-text">Carga laboral</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                    <span class="nav-text">Recursos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
