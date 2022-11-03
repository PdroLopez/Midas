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
    <div class="container">
        <div class="card">
            <div class="card-header">
                
            <h2>Bienvenid@ <b>{{ Auth::user()->name }} {{ Auth::user()->apellido }}, {{ Auth::user()->rol->name }}</b></h2>
            <h5>Por el momento no tiene ningun modulo, ni menú para navegar.</h5>
            
            </div>
           
        </div>
    </div>
@endsection