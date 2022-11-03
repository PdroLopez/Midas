<div class="modal fade" id="retiro{{ $retiro->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{ asset('/private/chofer/retirado') }}/{{ $retiro->id }}" files="true" enctype="multipart/form-data">
        @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Foto de articulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label>Imagenes</label>
                <input type="file" name="foto" id="foto" {{-- class="SubirFoto"  --}}accept="image/*" capture="camera"/>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                {!!Form::textarea('observacion_retirado',null,['class'=>"form-control", 'placeholder'=>'Escribir alguna observación','rows'=>'2'])!!}
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
    </form>
</div>
{{-- <style>
        *, *.before, *:after {
            box-sizing:border-box;
        }
        
        body {
            font-family: Avenir, 'Helvetica Neue', 'Lato', 'Segoe UI', Helvetica, Arial, sans-serif;
        }
        
        #Selector {
            width: 200px;
            margin: 0 auto;
        }
        
        .SubirFoto {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
            line-height: normal;
            font.size: 100%
            margin:0;
        }
        
        .SubirFoto + label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #d3394c;
            display: inline-block;
            text-overflow: ellipsis;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            padding: 0.6rem 1.2rem;
            cursor: pointer;
        }

        .SubirFoto:focus + label,
        .SubirFoto + label:hover {
            color: orange;
            outline: 1px dotted #000;
            fill: orange;
        }
        
        .SubirFoto + label figure {
            width: 100%;
            height: 100%;
            fill: #f1e5e6;
            border-radius: 50%;
            background-color: #d3394c;
            display: block;
            padding: 20px;
            margin: 0 auto 10px;
        }
        
        .SubirFoto + label:hover figure {
            background:orange;
        }
        
        inputfile + label svg {
            vertical-align: middle;
            width: 100%;
            height: 100%;
            fill: #f1e5e6;
        }
    </style> --}}