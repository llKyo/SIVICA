<h4 class="ui horizontal dividing header"><i class="configure icon"></i>Editar Diagnostico / Reparacion de:  {{$diag_repair->element->name}}</h4>
<form class="ui form" action="/element_diag_rapair/{{ $diag_repair->id }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="element_id" value="{{$diag_repair->element->id}}">
    <div class="one fields">
        <div class="grouped fields">
            <label for="fruit">Selecciona Opcion</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="option"  {{$diag_repair->option=='diagnostic' ? 'checked="checked"':''}}  value="diagnostic"  tabindex="0" class="hidden">
                <label>Diagnostico</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="option" {{$diag_repair->option=='repair' ? 'checked="checked"':''}} value="repair" tabindex="0" class="hidden">
                <label>Reparacion</label>
              </div>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>Fecha de Certificacion</label>
            <div class="input">
                <div class="ui calendar" id="date2">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" name="date" value="{{$diag_repair->date}}" placeholder="Date">
                  </div>
                </div>
            </div>
        </div>
        <div class="field"  >
            <label>Descripcion / Observaciones</label>
            <div class="ui input">
                <textarea rows="2"  name="check_observation"   required>{{$diag_repair->check_observation}}</textarea>
            </div>
        </div>

    </div>
    <div class="two fields">
        <div class="field">
            <label>Documento</label>
            <input  type="file" id="doc_diag" placeholder="" name="doc" class=""/>
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
    $('.ui.radio.checkbox').checkbox();
    $('select.dropdown').dropdown();
</script>
