@extends('layouts.app')
@section('content')

<div class="sixteen wide column">


<h4 class="ui horizontal dividing header"><i class="configure icon"></i>Asignar Documento</h4>
<label class="ui large green label"> Mantencion </label>
<span class="ui blue medium label"><i class="calendar icon"></i>  Mes / Año  :  {{$maintenance->month_mma}} , {{$maintenance->year_mma}} </span>
<span class="ui blue medium label"><i class="marker icon"></i> Estacion : {{$maintenance->station->name}} </span>
<span class="ui blue medium label"><i class="settings icon"></i> Actividad : {{$maintenance->activity->name}} </span>
<span class="ui blue medium label"><i class="flag icon"></i> Equipo : {{ $maintenance->element== null ? '-' : $maintenance->element->name }}  </span> <br><br>
<form class="ui form" action="/assign_document" method="post">
{{ csrf_field() }}
<input type="hidden" name="maintenance_id" value="{{ $maintenance->id}}">
    <div class="three fields">
        <div class="field">
            <label>Elija un Documento</label>
                <select class="ui search dropdown" name="document_id" required>
                    @forelse($documents as $document)

                    @if($document->version != null  && $document->version != 1)
                    <option value="{{$document->id}}">{{ $document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version }} </option>
                    @else
                    <option value="{{$document->id}}">{{ $document->station->name.' '.$document->code.' '.$document->label }} </option>
                    @endif

                    @empty
                    @endforelse
                </select>
        </div>

        <div class="field">
            <label>Fecha de Ejecucion (Cuando se realiza)</label>
            <div class="input">
                <div class="ui calendar" id="date">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" name="execution_date" placeholder="Fecha Ejecucion" value="" required>
                  </div>
                </div>
            </div>
        </div>
        <div class="field">
            <label> Observacion / Descripcion </label>
            <div class="ui  input">
                <textarea  name="check_observation"  rows="2"  required></textarea>
            </div>
        </div>
    </div>

    <div class="actions">
    <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="lab icon"></i> Asignar
    </button>
    <a class="ui right floated small cancel blue button" href="/assign_document">Volver</a><br>
    </div>
</form>
<script type="text/javascript">
    $('select.dropdown').dropdown();
</script>


</div>{{-- div From App--}}

@endsection
