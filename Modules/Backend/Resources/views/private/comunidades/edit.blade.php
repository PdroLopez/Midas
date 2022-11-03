<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$comunidades->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-comunidades.update',$comunidades->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Comunidad
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$comunidades->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..."])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="descripcion"  type="text" placeholder="Ingrese una Descripción...">{{$comunidades->descripcion}}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <br>
                            <img  src="{{asset('storage/'.$comunidades->foto)}}" width="20%;" height="auto">

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Foto</label>
                                <div class="custom-file">
                                    <input id="input-b1" name="foto" type="file" class="file" data-browse-on-zone-click="true">
                                    {{-- <label class="custom-file-label" for="customFile">Seleccionar archivo</label> --}}
                                </div>
                        </div>
                    </div>




                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Tipo de Comunidades</label>
                            {!!Form::select('tipo_comunidades_id',$tipo_comunidad,$comunidades->tipo_comunidades['id'],['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..."])!!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>






















