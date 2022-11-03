<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         {!!Form::open(['route' => 'mantenedor-usuarios.store', 'method' => 'POST','files'=>true])!!}
            @csrf
        <div class="modal-body">
            <div class="form-group">
               <label>Nombre</label>
               <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Apellido</label>
              <input type="text" name="apellido" class="form-control">
            </div>
            <div class="row">
                <div class="col-9">
                  <label>Rut</label>
                    <div class="form-group">
                        {!!Form::number('rut',null,['class'=>"form-control", 'placeholder'=>"Ingrese su rut" , 'required','onchange'=>"verificarRut()",'id'=>"rut",'maxlength'=>"8"])!!}
                    </div>
                </div>
                <div class="col-3">
                  <label>DV</label>
                    <div class="form-group">
                        {!!Form::text('dv',null,['class'=>"form-control", 'placeholder'=>"DV" , 'required','onchange'=>"verificarRut()",'id'=>"dv",'maxlength'=>"1"])!!}
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Fecha Nacimiento</label>
              {!!Form::date('fecha_nacimiento',null,['class'=>"form-control", 'placeholder'=>"Ingrese una fecha" , 'required'])!!}
            </div>
             <div class="form-group">
                <label for="">Rol</label>
                {!!Form::select('roles_id',$rol,null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
             </div>
            <div class="form-group">
               <label>Correo</label>
               <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Region</label>
              <select name="bk_regiones_id" id="region" class="form-control" placeholder="Seleccione una Region" onchange="select(this.value)">

                <option value="">Seleccione una Región</option>
                @foreach($region as $regiones)
                    <option value="{{ $regiones->id }}">{{ $regiones->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Comuna</label>
                <select name="bk_comunas_id" id="comuna" class="form-control" placeholder="Seleccione una Region">
                  <option value="">Seleccione una Comuna</option>
                </select>
            </div>
            <div class="form-group">
              <label>Direccion</label>
              {!!Form::text('direccion',null,['class'=>"form-control", 'placeholder'=>"Ingrese dirección..." , 'required'])!!}
            </div>
            <div class="form-group">
              <label>Teléfono</label>
              <input id="telefono" type="number" class="form-control" name="telefono" placeholder="Telefono" required autocomplete="telefono" >
            </div>
            <div class="form-group">
               <label>foto</label>
               <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group">
               <label>Contraseña</label>
               <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
               <label>Confirmar contraseña</label>
               <input type="password" name="confirmar_contraseña" class="form-control">
            </div>
          <button class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        {!!Form::close()!!}
     </div>
  </div>
</div>
<script>
function select(id) {
  $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
      //console.log(data);
      var producto_select = '<option value="">Seleccione Comuna</option>'
      for (var i = 0; i < data.length; i++)
          producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

     document.getElementById('comuna').innerHTML = producto_select;

  });
}
</script>