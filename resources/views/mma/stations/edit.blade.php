@extends('layouts.app')
@section('content')
<style media="screen">
    #divMap_edit { width: 100%; height: 200px;border:1px solid gray;}
</style>
        <div class="sixteen wide column">
            <h4 class="ui horizontal dividing header"><i class="marker icon"></i>Editar Estacion</h4>
            <form class="ui form" action="/stations/{{ $station->id}}" method="post">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="three  fields">
                    <div class="field">
                        <label>Nombre de Estacion</label>
                        <div class="ui  input">
                            <input type="text" name="name" placeholder="Ingrese Nombre" value="{{ $station->name}}" required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Direccion <small>(Calle numero , comuna, pais)</small></label>
                        <div class="ui icon input">
                            <input type="text" name="address" id="address_edit" value="{{ $station->address}}" placeholder="Direccion" required>
                                <i class="marker red inverted circular link icon"  onclick="getCoordinates()" title="Clic para ver en Mapa!"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Ciudad</label>

                            <select class="ui search dropdown" name="city_id" required>
                                @forelse($cities as $city)
                                <option value="{{ $city->id}}" {{ $station->city_id == $city->id ? 'selected="selected"' : ''}}>{{ $city->label }}</option>
                                @empty
                                <span>Sin datos aun!</span>
                                @endforelse
                            </select>

                    </div>
                </div>
                <div class="two fields">

                    <div class="field">
                        <label>Estado de la estacion</label>

                            <select class="ui dropdown" name="state" required>
                                <option value="enable" {{ $station->state == 'enable' ? 'selected="selected"' : ''}}>Operativa</option>
                                <option value="disable" {{ $station->state == 'disable' ? 'selected="selected"' : ''}}>No Operativa</option>
                            </select>

                    </div>
                    <div class="field">
                        <p>&nbsp;Latitud:&nbsp;<div class="ui  input"><input class="latitud" name="lat" value="{{ $station->lat}}" required></div></p>
                        <p>&nbsp;Longitud:&nbsp;<div class="ui  input"><input class="longitud" name="lng" value="{{ $station->lng}}" required></div></p>
                    </div>

                        </div>
                        <div id="divMap_edit"></div>
                        <br>
                        <div class="actions">
                        <button class="ui right floated small green labeled cancel icon button" type="submit">
                            <i class="marker icon"></i> Actualizar
                        </button>
                        <a href="{{ url('/stations')}}" class="ui right floated small  blue button">Volver</a><br>
                        </div>
                    </form>

                    <script type="text/javascript">


                            $('select.dropdown').dropdown();
                            map2 = new L.map('divMap_edit');

                        	// create the tile layer with correct attribution
                        	var osmUrl='http://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}';
                        	var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
                        	var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});

                        	// start the map in South-East England
                        	map2.setView(new L.LatLng({{ $station->lat}},{{ $station->lng}}),15);
                        	map2.addLayer(osm);
                            var marker2 = L.marker([{{ $station->lat}}, {{ $station->lng}}],{draggable: true}).addTo(map2).bindPopup('Aqui Estas!').openPopup();
                            var popup = L.popup();

                            marker2.on("dragend", function(ev) {
                                var chagedPos = ev.target.getLatLng();
                                //this.bindPopup(chagedPos.toString()).openPopup();
                                this.bindPopup('Aqui Estas!').openPopup();
                                $('.latitud').val(chagedPos.lat);
                                $('.longitud').val(chagedPos.lng);
                            });


                            function getCoordinates(){
                                var dir = $( "#address_edit" ).val();
                                   $.ajax({
                                   url:"/getCoordinates",
                                   headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                                   method: 'POST',
                                   data:{address:dir},
                                   success: function(data){
                                       var latlng = data.split(",");
                                       var latitude = latlng[0];
                                       var longitude = latlng[1];
                                       marker2.setLatLng([latitude,longitude]).update();
                                       $('.latitud').val(latitude);
                                       $('.longitud').val(longitude);
                                       map2.setView(new L.LatLng(latitude, longitude),15);
                                       }
                                   });
                            }

                    </script>

@endsection
