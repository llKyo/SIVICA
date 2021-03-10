<form class="ui form" action="/elements_inventary/{{$element->id}}" method="post">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="four  fields">
        <div class="field">
            <label>Equipo</label>

                <select class="ui search dropdown" name="name_id" required>
                    @forelse($names as $name)
                            <option value="{{ $name->id }}" {{ $element->name->id == $name->id ? 'selected="selected"':''}} >{{ $name->name }}</option>
                    @empty
                    @endforelse
                </select>
        </div>
        <div class="field">
            <label>Marca</label>
            <div class="ui  input">
                <input type="text" name="brand" placeholder="Ingrese Marca" value="{{$element->brand}}"  required>
            </div>
        </div>
        <div class="field">
            <label>Modelo</label>
            <div class="ui  input">
                <input type="text" name="model" placeholder="Ingrese Modelo" value="{{$element->model}}" required>
            </div>
        </div>
        <div class="field">
            <label>Numero de Serie</label>
            <div class="ui  input">
                <input type="text" name="sn" placeholder="Ingrese Numero de Serie" value="{{$element->sn}}" required>
            </div>
        </div>

    </div>
    <div class="four fields">
        <div class="field">
            <label>Propietario</label>
            <div class="ui  input">
                <input type="text" name="owner" placeholder="Ingrese Propietario" value="{{$element->owner}}" required>
            </div>
        </div>
        <div class="field">
            <label>Descripcion</label>
            <div class="ui  input">
                <textarea  name="description"  rows="2"  required>{{$element->description}}</textarea>
            </div>
        </div>
        <div class="field">
            <label>Tipo de Equipo</label>

                <select class="ui search dropdown" name="type_id">
                    @forelse($types as $type)
                            <option value="{{ $type->id }}" {{ $element->type->id == $type->id ? 'selected="selected"':''}}>{{ $type->name }}</option>
                    @empty
                    @endforelse
                </select>

        </div>
        <div class="field">
            <label>Estado: </label>
                <select class="ui dropdown" name="state" required>
                    <option value="enable" {{ $element->state == 'enable' ? 'selected="selected"':''}}>Operativo</option>
                    <option value="disable" {{ $element->state == 'disable' ? 'selected="selected"':''}}>No Operativo</option>
                </select>

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
 //    $('select.dropdown').dropdown();
</script>
