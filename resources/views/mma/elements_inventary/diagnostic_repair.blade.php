<h4 class="ui horizontal dividing header"><i class="configure icon"></i>Registrar Diagnostico / Reparacion de:  {{$element->name->name}}</h4>
<form class="ui form" action="/element_diag_rapair" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

    <input type="hidden" name="element_id" value="{{$element->id}}">
    <div class="one fields">
        <div class="grouped fields">
            <label for="fruit">Selecciona Opcion</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="option"  checked="" value="diagnostic"  tabindex="0" class="hidden">
                <label>Diagnostico</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="option" value="repair" tabindex="0" class="hidden">
                <label>Reparacion</label>
              </div>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>Fecha</label>
            <div class="input">
                <div class="ui calendar" id="date2">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" name="date" value="" placeholder="Date">
                  </div>
                </div>
            </div>
        </div>
        <div class="field"  >
            <label>Descripcion / Observaciones</label>
            <div class="ui input">
                <textarea rows="2" name="check_observation"  required></textarea>
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
</script>
