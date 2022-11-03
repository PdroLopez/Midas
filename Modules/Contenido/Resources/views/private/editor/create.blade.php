@extends('layouts.backend.master')
@section('content')
<style type="text/css">
  .label.label-info {
    color: #ffffff;
    background-color: #8950FC;
    width: auto;
    border-radius: 4px;
    padding: 6px;
  }
</style>
<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Crear Noticias</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Noticas</a>
                    </li>
                </ul>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm ml-5">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Editor</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
      {!!Form::open(['route' => 'mantenedor-noticias.store', 'method' => 'POST','files'=>true])!!}

            <div class="card-header">
                Noticias estandar
            </div>
            <div class="card-body">
                <div class="row">
            <div class="form-group col-6">
               <label>Titulo</label>
               <input type="text" name="titulo" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Subtitulo</label>
               <input class="form-control" name="subtitulo" type="text">
            </div>
            <div class="form-group col-12">
               <label>Slug</label>
               <input class="form-control" name="slug" type="text">
            </div>
            <div class="form-group well col-12">
                <label for="tags">Etiquetas (palabras separadas por coma)</label>
                <input type="text" name="tags" data-role="tagsinput" class="form-control">
            </div>
            <div class="form-group col-12">
               <label>Descripción</label>
               <textarea class="ckeditor" name="descripcion" ></textarea>
            </div>
            <div class="form-group col-12">
                <label>Descripción</label>
                <textarea class="ckeditor" name="descripcion" ></textarea>
             </div>
            <div class="form-group col-6">
               <label>Peso</label>
               <input type="number" name="peso" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>URL de redirección</label>
               <input type="text" name="url" class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen detalle</label>
               <input type="file" name="imagenDetalle" class="form-control" required>
            </div>
            <div class="form-group col-6">
               <label>Imagen portada</label>
               <input type="file" name="imagenPortada" class="form-control" required>
            </div>
            <div class="form-group col-6">
               <label>Imagen descripción</label>
               <input type="file" name="imagenDescripcion" required class="form-control">
            </div>
            <div class="form-group col-6">
               <label>Imagen miniatura</label>
               <input type="file" name="imagenMiniatura" class="form-control" required>
            </div>
           </div>
               <button class="btn btn-primary">
                   Registrar
               </button>
            </div>
           {!!Form::close()!!}

        </div>
    </div>
    @include('contenido::private.editor.modal.noticias.estandar.create')
@endsection
