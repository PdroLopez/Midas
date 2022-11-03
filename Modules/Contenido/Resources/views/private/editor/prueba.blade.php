@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Noticias</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Editor</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-title">
            <h6>
                Imagenes de la Noticia
            </h6>
        </div>

        <div class="card-body">



            <div class="row">
                @foreach ($imagen as $item)
                {{Form::open(array("url"=>"/contenido/editor/editar-imagen/".$item->id,"method" => "put","files"=>"true"))}}
                <div class="col-6">
                    <div class="form-group">
                        <img src="{{asset('storage/'.$item->portada)}}" width="50%" height="auto">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Imagen Portada</label>
                        <input type="file" name="imagenPortada" class="form-control"  required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <img src="{{asset('storage/'.$item->detalle)}}" width="50%" height="auto">
                    </div>


                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Imagen Detalle</label>
                        <input type="file" name="imagenDetalle" class="form-control" required>
                    </div>

                </div>

                <div class="col-6">
                    <div class="form-group">
                        <img src="{{asset('storage/'.$item->img_descripcion )}}" width="50%" height="auto">
                    </div>


                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Imagen descripción</label>
                        <input type="file" name="imagenDescripcion" class="form-control" required>
                    </div>

                </div>

                <div class="col-6">
                    <div class="form-group">
                        <img src="{{asset('storage/'.$item->miniatura)}}" width="50%" height="auto">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Imagen miniatura</label>
                        <input type="file" name="imagenMiniatura" class="form-control" required>
                    </div>

                </div>
                <button class="btn btn-primary">
                    Actualizar
                </button>

                <a class="btn btn-primary" href="{{asset('contenido/editor/noticias')}}">Volver</a>
                {!! Form::close() !!}
                @endforeach

            </div>


        </div>
    </div>
</div>
@endsection
