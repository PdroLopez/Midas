<a class="modal-with-form mb-1 mt-1 mr-1 btn btn-xs btn btn-primary" href="#Detalle{{$rol->id}}">Detalle</i></a>

<div id="Detalle{{$rol->id}}" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Detalle rol {{$rol->name}}</h2>
        </header>
                <div class="card-body">
                    <div class="form-group">
                        <ul>
                            
                        @foreach ($rol->nav_role as $nav_role)
                            <li>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{$nav_role->nav->nombre}} 
                                        @if ($nav_role->modulos_id != null)
                                            <strong>
                                            ( {{$nav_role->modulos->nombre}} )
                                            </strong>
                                        @endif
                                        @if ($nav_role->nav->sub_nav == 0)
                                            <ul>
                                                @foreach ($nav_role->nav->hijos as $hijos)
                                                <li>
                                                    {{$hijos->nombre}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::open(['route'=>['nav-rol.delete',$nav_role->id],'method'=>'delete']) !!}
                                            <button class="mb-1 mt-1 mr-1 btn btn btn-danger" onclick="return confirm('¿Quiere borrar el registro?')"
                                            >Eliminar</button>
                                        {!! Form::close() !!} 
                                    </div>
                                </div>
                                <hr>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
    </section>
</div>
