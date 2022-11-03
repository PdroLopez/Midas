{!! Form::open(['route' => ['mantenedor-comentarios.update',$comentarios->id],'files'=>true, 'method' => 'PUT']) !!}
    <button class="btn btn-light-primary" style="cursor: pointer;" onclick="return confirm('¿Esta seguro que desea denunciar?')"> Denunciar</button>
{!! Form::close() !!}