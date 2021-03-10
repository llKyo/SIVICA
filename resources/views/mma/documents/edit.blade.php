<h4 class="ui horizontal dividing header"><i class="file text icon"></i>Editar Reporte</h4>
<form class="ui form" action="/documents/{{ $document->id }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(Auth::user()->rol == 'admin')
    <div class="one fields">

            <div class="field">
                <label>Nombre (Nombre Documento / Version) * </label>
                <div class="ui input">
                    <input type="text" name="label" value="{{ $document->label }}" required>
                </div>

            </div>

    </div>
    <div class="one fields">
        <div class="field">
            <label>Documento</label>
            <input  type="file" id="doc_cert" placeholder="" name="doc" class=""/>
             <small style="color:red"> Solo si se quiere cambiar!</small>
        </div>
    </div>
    @endif
    <div class="two fields">
        <div class="field">
            <label>Estacion *</label>
            <select class="ui search dropdown" name="station_id" required>
                @forelse($stations as $station)
                    <option value="{{$station->id}}" {{ $station->id == $document->station_id ? 'selected="selected"':''}}>{{$station->name}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="field">
            <label>Periodo *</label>
            <select class="ui search dropdown" name="period_id" required>
                @forelse($periods as $period)
                    <option value="{{$period->id}}" {{ $period->id == $document->period_id ? 'selected="selected"':''}}>{{$period->description}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="field">
            <label>Descripcion (del Documento) *</label>
            <div class="ui input">
                <textarea rows="2" name="description"  required>{{ $document->description }}</textarea>
            </div>
        </div>
    </div>



    <button class="ui right floated small green labeled icon button" type="submit" data-content="Actualizar Reporte">
        <i class="file text icon"></i> Actualizar Reporte
    </button>
    <br>
</form>
