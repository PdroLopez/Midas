@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-6 col-10">
                    <h1 class="display-4 font-weight-normal">Home</h1>
                </div>
                <div class="d-md-none d-flex col-2">
                    <a href="{{ url()->previous() }}">
                        <span class="svg-icon svg-icon-lg svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#8fca00" opacity="0.3" cx="12" cy="12" r="10" style="fill: #8fca00;opacity: 1;"/>
                                    <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" fill="#8fca00" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " style="fill:white;"/>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="col-md-4 col-10 pt-5">
                    <span></span>
                </div>
                <div class="d-md-flex d-none col-2 pt-2">
                    <a href="{{ url()->previous() }}">
                        <span class="svg-icon svg-icon-lg svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#8fca00" opacity="0.3" cx="12" cy="12" r="10" style="fill: #8fca00;opacity: 1;"/>
                                    <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" fill="#8fca00" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " style="fill:white;"/>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>

    <div class="container mt-md-20 mt-10 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-8 p-md-10 p-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="solicitudes-tab" data-toggle="tab" href="#solicitudes" role="tab" aria-controls="solicitudes" aria-selected="true">Solicitudes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                    </li>
                </ul>
                <div class="tab-content mt-10" id="myTabContent">
                    <div class="tab-pane fade show active" id="solicitudes" role="tabpanel" aria-labelledby="solicitudes-tab">
                        <div class="tab-content mt-5 px-md-10 px-0" id="myTabLIist18">
                            <div class="d-flex align-items-center pb-9">
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-md text-hover-primary mb-1">Camila Soto</a>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-primary">Retirado</span>
                                        </div>
                                    </div>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las hortencias #123</span>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las Condes, Santiago</span>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <a href="{{ asset('/private/chofer/detalle-retiro/1') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleSelectd">
                                                    <option selected>Acci??n</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-9">
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-md text-hover-primary mb-1">Camila Soto</a>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-warning">Por Retirar</span>
                                        </div>
                                    </div>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las hortencias #123</span>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las Condes, Santiago</span>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <a href="{{ asset('/private/chofer/detalle-retiro/1') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleSelectd">
                                                    <option selected>Acci??n</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-9">
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-md text-hover-primary mb-1">Camila Soto</a>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-warning">Por Retirar</span>
                                        </div>
                                    </div>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las hortencias #123</span>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las Condes, Santiago</span>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <a href="{{ asset('/private/chofer/detalle-retiro/1') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleSelectd">
                                                    <option selected>Acci??n</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-6">
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-md text-hover-primary mb-1">Camila Soto</a>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-warning">Por Retirar</span>
                                        </div>
                                    </div>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las hortencias #123</span>
                                    <span class="text-dark-50 font-weight-normal font-size-sm">Las Condes, Santiago</span>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <a href="{{ asset('/private/chofer/detalle-retiro/1') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleSelectd">
                                                    <option selected>Acci??n</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="historial-tab">
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection