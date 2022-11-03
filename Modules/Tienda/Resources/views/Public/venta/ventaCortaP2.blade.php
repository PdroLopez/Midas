@extends('tienda::layouts.public.master')
@section('tienda::content')

    <script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWBZH35d3KInFEPtoHnQ8M03zYgj0LG7A&callback=initAutocomplete&libraries=places&v=weekly"
defer
></script>

<div class="container">
  <center>
      <div class="row">
          <div class="col">
            <h1>Ingrese los datos del comprador</h1>
          </div>
      </div>
      <div class="row">
        <div class="col">
          {!!Form::open(['route' => 'mantenedor-venta-fuera.store', 'method' => 'POST','files'=>true])!!}<input type="hidden" name="producto_id" value="{{$producto->id}}">
              <div class="form-group">
                <label>Nombre Completo</label>
                <input name="nombre" type="text" class="form-control" placeholder="" required>
              </div>
              <div class="form-group">
                <label>Celular</label>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button class="btn btn-default" >+ 56 9</button>
                  </div>
                  <input name="telefono" type="text" pattern=".{8,8}" maxlength="8" class="form-control" placeholder="87654321" required>
                  {{-- min="8" max="8" --}}
                </div>

              </div>
              <div class="form-group">
                <label>Correo electrónico ( Opcional )</label>
                <div class="input-group">
                 
                  <input name="correo" type="text" class="form-control" placeholder="">


                </div>

              </div>
{{--               <div class="form-group">
                  <div id="pac-container">
                    <label>Dirección de despacho</label>
                  <input name="direccion" id="pac-input" type="text" class="form-control" placeholder="" required>
                </div>
              </div> --}}
              <div class="form-group row">
                  <div class="col-6">
                      <label>Región</label>
                      <select name="bk_regiones_id" class="form-control" onchange="BuscarComuna(this.value);" required>
                          <option value="0">Seleccionar</option>
                          @foreach($region as $re)
                            <option value="{{$re->id}}">{{$re->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-6">
                      <label>Comuna</label>
                      <select name="bk_comunas_id" id="comuna_select" class="form-control" required>
                          <option value="">Seleccionar</option>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <label>Dirección</label>
                  <input name="direccion" type="text" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                  <label>Algún detalle de Dirección</label>
                  <input name="detalle" type="text" class="form-control" placeholder="">
              </div>
              {{-- <div id="map"></div> --}}
              <div class="row">
                <div class="col-6" id="boton_siguiente">
                    <button class="btn btn-primary" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;" type="submit">Siguiente Paso</button> 
                </div>
                <div class="col-6" id="boton_cancelar">
                    <a href="{{ asset('/tienda/venta-corta/cancelar') }}" class="btn btn-danger" onclick="return confirm('¿Quiere cancelar la compra? Se borraran todos los datos ingresados')" style="background-color: red;border-color:red;">Cancelar</a>
                </div>
              </div>
          {!!Form::close()!!}
        </div>
      </div>
  </center>
</div>
   
<div id="map"></div>   
                  
    </div>

</div>
   
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWBZH35d3KInFEPtoHnQ8M03zYgj0LG7A&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>


<script>
  // This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script >
function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 13,
    mapTypeId: "roadmap",
  });
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  let markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };
      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}
</script>



 <style>
     .cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}

.cc-selector-2 input{
    position:absolute;
    z-index:999;
}

.visa{background-image:url('{{asset('/tarjeta.jpg')}}');}
.mastercard{background-image:url('{{asset('/webpay.jpg')}}');}

.cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
.cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
    -webkit-filter: none;
       -moz-filter: none;
            filter: none;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    width:100px;height:70px;
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);
}
.drinkcard-cc:hover{
    -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
       -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
            filter: brightness(1.2) grayscale(.5) opacity(.9);
}

/* Extras */
a:visited{color:#888}
a{color:#444;text-decoration:none;}
p{margin-bottom:.3em;}
* { font-family:monospace; }
.cc-selector-2 input{ margin: 5px 0 0 12px; }
.cc-selector-2 label{ margin-left: 7px; }
span.cc{ color:#6d84b4 }
 </style>

<script type="text/javascript">
  function BuscarComuna(id){
    $.get("{{ asset('tienda/venta-corta/buscar-comuna') }}/"+id,function(response, compania){
        $("#comuna_select").empty();
        $("#comuna_select").append(`<option value="">Seleccionar</option>`);
        response.forEach(element => {
          $("#comuna_select").append(`<option value="${element.id}"> ${element.nombre} </option>`);
        });
    });
  }


</script>
<script> 
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        document.getElementById("boton_siguiente").style.padding="0%";
        document.getElementById("boton_cancelar").style.padding="0%";
      }else{
        document.getElementById("boton_siguiente").style.padding="0% 0% 0% 34%";
        document.getElementById("boton_cancelar").style.padding="0% 40% 0% 0%";
      }
</script>



@endsection