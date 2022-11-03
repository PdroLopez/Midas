
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="elegircombo" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Combos disponibles
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
        {!!Form::open(['url' => 'retiro-corto/elegir-combo', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
          <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y">
            <div class="row gutter-b">
              @foreach($combos as $com)
                <div class="col-6" style="padding:5%;">
                  <input type="radio" name="combos" value="{{ $com->id }}" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
                      <img style="width:50px" src="{{asset('storage/'.$com->img)}}"></img>
                    <span class="d-block font-weight-bold font-size-h6 mt-2">{{ $com->nombre }}<br><small>Valor ${{$com->valor}}</small>
                    </span>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
          <button type="submit" class="btn btn-primary" >Guardar</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>