
@extends('layouts.app')
@section('content')
<style media="screen">
#divMap { width: 100%; height: 200px;border:1px solid gray;}
</style>
<div class="sixteen wide column">
  <h1>Estaciones</h1>
  @if(Auth::user()->rol !='observer')
  <h4 class="ui horizontal dividing header"><i class="marker icon"></i>Crear Nueva Estacion</h4>
  <form class="ui form" action="/stations" method="post">
    {{ csrf_field() }}
    <div class="three  fields">
      <div class="field">
        <label>Nombre de Estacion</label>
        <div class="ui  input">
          <input type="text" name="name" placeholder="Ingrese Nombre" required>
        </div>
      </div>
      <div class="field">
        <label>Direccion (Calle Numero Comuna Pais)</label>
        <div class="ui icon  input">
          <input type="text" name="address" id="address" placeholder="Direccion" required>
          <i class="marker red inverted circular link icon"  onclick="getCoordinates()" title="Clic para ver en Mapa!"></i>
        </div>
      </div>
      <div class="field">
        <label>Ciudad</label>
        <select class="ui search dropdown" name="city_id" required>
          @forelse($cities as $city)
          <option value="{{ $city->id}}" >{{ $city->label }}</option>
          @empty
          <span>Sin datos aun!</span>
          @endforelse
        </select>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <div id="divMap"></div>
      </div>
      <div class="field">
        <label>Estado de la estacion</label>
        <select class="ui dropdown " name="state" required>
          <option value="enable" selected="selected">Operativa</option>
          <option value="disable">No Operativa</option>
        </select>
      </div>
      <div class="field">
        <p>&nbsp;Latitud:&nbsp;<div class="ui  input"><input class="latitud" name="lat" value="-33.4432231" required /> </div></p>
        <p>&nbsp;Longitud:&nbsp;<div class="ui  input"><input class="longitud" name="lng" value="-70.6575371" required /></div></p>
      </div>
    </div>
    <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nueva Estacion">
      <i class="marker icon"></i> Crear Estacion
    </button>
  </form>
  @endif
  <h4 class="ui horizontal dividing  header"><i class="marker icon"></i>Lista de Estaciones</h4>
  <table class="ui celled table sortable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Ciudad</th>
        <th>Lat/Lng</th>
        <th>Estado</th>
        @if(Auth::user()->rol !='observer')
        <th>Acciones</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @forelse($stations as $station)
      <tr>
        <td>{{ $station->name}}</td>
        <td>{{ $station->address}}</td>
        <td>{{ $station->city->label}}</td>
        <td>lat:{{ $station->lat}}<br>lng:{{ $station->lng}}</td>
        <td>{{ $station->state == 'disable' ? 'No Operativa' : 'Operativa'}}</td>
        @if(Auth::user()->rol !='observer')
        <td>
          <a class="circular ui mini icon defaut button" href="/stations/{{ $station->id }}/edit"  title="Editar" style="float:left;">
            <i class="icon blue edit"></i>
          </a>
          <form id="del_" action="/stations/{{ $station->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar la estacion !?, sus datos asociados podrian perderse')){return false;}" >
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
              <i class="icon red remove"></i>
            </button>
          </form>
        </td>
        @endif
      </tr>
      @empty
      <span>sin registros aun</span>
      @endforelse
    </tbody>
  </table>
  {{-- Modal Edit--}}
  <div class="ui small info modal edit_modal">
    <div class="content"></div>
  </div>
  <script type="text/javascript">
  map = new L.map('divMap');
  // create the tile layer with correct attribution
  var osmUrl='http://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}';
  var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
  var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});

  // start the map in South-East England
  map.setView(new L.LatLng(-33.449, -70.669),15);
  map.addLayer(osm);
  var marker = L.marker([-33.449, -70.669],{draggable: true}).addTo(map).bindPopup('Aqui Estas!').openPopup();
  var popup = L.popup();

  marker.on("dragend", function(ev) {
    var chagedPos = ev.target.getLatLng();
    //this.bindPopup(chagedPos.toString()).openPopup();
    this.bindPopup('Aqui Estas!').openPopup();
    $('.latitud').val(chagedPos.lat);
    $('.longitud').val(chagedPos.lng);
  });

  function getCoordinates(){
    var dir = $( "#address" ).val();
    $.ajax({
      url:"/getCoordinates",
      headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
      method: 'POST',
      data:{address:dir},
      success: function(data){
        var latlng = data.split(",");
        var latitude = latlng[0];
        var longitude = latlng[1];
        marker.setLatLng([latitude,longitude]).update();
        $('.latitud').val(latitude);
        $('.longitud').val(longitude);
        map.setView(new L.LatLng(latitude, longitude),15);
      }
    });
  }
</script>
</div>{{-- div From App--}}
</div>{{-- div From App--}}
@endsection
