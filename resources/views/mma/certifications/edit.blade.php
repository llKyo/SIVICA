<form class="ui form" action="/certifications/{{$certification->id}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="four  fields">
        <div class="field">
            <label>Fecha de Certificacion</label>

                <div class="input">
                    <div class="ui calendar" id="date2">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="date" value="{{$certification->date}}" placeholder="Date">
                      </div>
                    </div>
                </div>

        </div>
        <div class="field">
            <label>Tipo / Marca</label>
            <div class="ui input">
                <input type="text" name="type_brand"  value="{{$certification->type_brand}}" required>
            </div>
        </div>
        <div class="field">
            <label>Numero de Serie</label>
            <div class="ui input">
                <input type="text" name="sn" placeholder="Ingrese Numero de Serie" value="{{$certification->sn}}"required>
            </div>
        </div>
        <div class="field">
            <label>Duracion (Meses)</label>
            <div class="ui input">
                <input type="number" name="duration_time" placeholder="Ingrese duracion en meses" value="{{$certification->duration_time}}" required>
            </div>
        </div>

    </div>
    <div class="three fields">
        <div class="field">
            <label>Documento</label>
            <input  type="file" id="doc_cert" placeholder="" name="doc" class=""/>
        </div>

    </div>
    <div class="actions">
    <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="add user icon"></i> Actualizar
    </button>
    <div class="ui right floated small cancel blue button">Volver</div><br>
    </div>
</form>
<script type="text/javascript">
    $('select.dropdown').dropdown();
</script>
