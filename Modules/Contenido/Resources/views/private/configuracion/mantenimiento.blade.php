@extends('contenido::layouts.backend.master')
@section('contenido::content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Configuración de Mantenimiento</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Configuracion</a>
                    </li>
                    
                </ul>
            </div>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Configuración de Mantenimiento
            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label>En mantenimiento</label>
                        </div>
                        <div class="col-12">
                            <input type="radio" name="mantenimieto" value="si">
                            <label for="si">Si</label>
                            <br>
                            <input type="radio" name="mantenimieto" value="no">
                            <label for="no">No</label>
                        </div>
                    </div>
                    <button class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection