<h4 class="ui horizontal dividing header"><i class="flag icon"></i>Movimiento de Equipo - {{$element->name->name}}</h4>
<form class="ui form" action="/elements_movement" method="post">
{{ csrf_field() }}

    <input type="hidden" name="element_id" value="{{$element->id}}">

    <div class="two fields">
        <div class="field">
            <label>Tipo Movimiento</label>
                <select class="ui dropdown" name="movement" id="movement">
                    <option value="remove" >Solo Retira</option>
                    <option value="install" >Solo Instala</option>
                    <option value="station_to_estation" >Instala a otra Estacion</option>
                </select>
        </div>
        <div class="field" id="state_input">
            <label>Estado: </label>

                <select class="ui dropdown" name="state" required>
                    <option value="enable">Operativo</option>
                    <option value="disable">No Operativo</option>
                </select>

        </div>
    </div>




    <div class="three fields">
      <div class="field">
          <label>Fecha de Movimiento</label>
          <div class="input">
              <div class="ui calendar" id="date2">
                <div class="ui input left icon">
                  <i class="calendar icon"></i>
                  <input type="text" name="date" value="" placeholder="Date">
                </div>
              </div>
          </div>
      </div>
        <div class="field" id="station_input" style="display:none;">
            <label>en Estacion: </label>

                <select class="ui search dropdown" name="station_id">
                    @forelse($stations as $station)
                    <option value="{{ $station->id}}" >{{ $station->name}}</option>
                    @empty
                    <span>Sin Datos Aun</span>
                    @endforelse
                </select>

        </div>
        <div class="field" id="place_input" >
            <label>Lugar donde quedara...</label>
            <div class="ui input">
                <input type="text" name="place_input" placeholder="Lugar luego de retirar" value=" " required>
            </div>
        </div>
        <div class="field" id="observation_input" >
            <label>Observacion / Motivo</label>
            <div class="ui input">
                <textarea type="text" name="observation" rows="2" required></textarea>
            </div>
        </div>
    </div>
    <div class="actions">
    <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="lab icon"></i> Actualizar
    </button>
    <div class="ui right floated small cancel blue button">Volver</div><br>
    </div>
</form>
<script type="text/javascript">
    $('select.dropdown').dropdown();
    $('#movement').change(function(){
        if($(this).val()=='remove')
        {
            $('#state_input').css('display','block');
            $('#observation_input').css('display','block');
            $('#place_input').css('display','block');
            $('#station_input').css('display','none');
        }
        if($(this).val()=='install')
        {
            $('#state_input').css('display','block');
            $('#station_input').css('display','block');
            $('#observation_input').css('display','block');
            $('#place_input').css('display','none');
        }
        if($(this).val()=='station_to_estation')
        {
            $('#state_input').css('display','block');
            $('#station_input').css('display','block');
            $('#observation_input').css('display','block');
            $('#place_input').css('display','none');
        }
    });
</script>
