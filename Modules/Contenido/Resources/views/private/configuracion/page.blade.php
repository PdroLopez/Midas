@extends('contenido::layouts.backend.master')
@section('contenido::content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Pagina</h5>
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
                Configuración básica de portal
            </div>
            <div class="card-body">
                <form files="true">
                    @csrf
                    <div class="form-group">
                        <label>Titulo portal</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Titulo administración</label>
                        <input type="text" name="admin" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Titulo login</label>
                        <input type="text" name="login" class="form-control">
                    </div>
                    <div class="form-group">
                         <label>Copyright</label>
                         <input type="text" name="copyright" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Logo portal</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Logo administracion / login</label>
                        <input type="file" name="logoAdmin" class="form-control">
                    </div>
                    <button class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection