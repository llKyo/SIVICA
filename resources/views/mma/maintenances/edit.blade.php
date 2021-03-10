@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Editar Mantencion</h4>

<form class="ui form" action="/maintenances/{{ $maintenance->id}}" method="post">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="five  fields">
        <div class="field">
            <label>Actividad Asociada</label>
                <select class="ui" name="activity_id" id="activity_id_edit" required>
                    @forelse($activities as $activity)
                    <option value="{{ $activity->id}}" {{ $activity->id == $maintenance->activity_id ? 'selected="selected"':'' }}>
                        {{ $activity->name}}
                    </option>
                    @empty
                    @endforelse
                </select>
        </div>
        <div class="field">
            <label>Estacion Asociada</label>

                <select class="ui search dropdown" name="station_id" id="station_to_element" required>
                    <option value="" >Selecciona una estacion</option>
                    @forelse($stations as $station)
                    <option value="{{ $station->id}}" {{ $station->id == $maintenance->station_id ? 'selected="selected"':'' }}>
                        {{ $station->name}}
                    </option>
                    @empty
                    <span>Sin Datos Aun</span>
                    @endforelse
                </select>

        </div>

        <div class="field">
            <label>Año</label>
            <select class="ui  dropdown"  name="year_mma">
                <option value="2017" {{ $maintenance->year_mma == '2017' ? 'selected="selected"': '' }} >2017</option>
                <option value="2018" {{ $maintenance->year_mma == '2018' ? 'selected="selected"': '' }} >2018</option>
                <option value="2019" {{ $maintenance->year_mma == '2019' ? 'selected="selected"': '' }} >2019</option>
                <option value="2020" {{ $maintenance->year_mma == '2020' ? 'selected="selected"': '' }} >2020</option>
                <option value="2021" {{ $maintenance->year_mma == '2021' ? 'selected="selected"': '' }} >2021</option>
                <option value="2022" {{ $maintenance->year_mma == '2022' ? 'selected="selected"': '' }} >2022</option>
                <option value="2023" {{ $maintenance->year_mma == '2023' ? 'selected="selected"': '' }} >2023</option>
                <option value="2024" {{ $maintenance->year_mma == '2024' ? 'selected="selected"': '' }} >2024</option>
            </select>
        </div>

        <div class="field">
            <label>Mes</label>
            <select class="ui  dropdown"  name="month_mma">
                <option value="Enero" {{ $maintenance->month_mma == 'Enero' ? 'selected="selected"': '' }} >Enero</option>
                <option value="Febrero" {{ $maintenance->month_mma == 'Febrero' ? 'selected="selected"': '' }} >Febrero</option>
                <option value="Marzo" {{ $maintenance->month_mma == 'Marzo' ? 'selected="selected"': '' }} >Marzo</option>
                <option value="Abril" {{ $maintenance->month_mma == 'Abril' ? 'selected="selected"': '' }} >Abril</option>
                <option value="Mayo" {{ $maintenance->month_mma == 'Mayo' ? 'selected="selected"': '' }} >Mayo</option>
                <option value="Junio" {{ $maintenance->month_mma == 'Junio' ? 'selected="selected"': '' }} >Junio</option>
                <option value="Julio" {{ $maintenance->month_mma == 'Julio' ? 'selected="selected"': '' }} >Julio</option>
                <option value="Agosto" {{ $maintenance->month_mma == 'Agosto' ? 'selected="selected"': '' }} >Agosto</option>
                <option value="Septiembre" {{ $maintenance->month_mma == 'Septiembre' ? 'selected="selected"': '' }} >Septiembre</option>
                <option value="Octubre" {{ $maintenance->month_mma == 'Octubre' ? 'selected="selected"': '' }} >Octubre</option>
                <option value="Noviembre" {{ $maintenance->month_mma == 'Noviembre' ? 'selected="selected"': '' }} >Noviembre</option>
                <option value="Diciembre" {{ $maintenance->month_mma == 'Diciembre' ? 'selected="selected"': '' }} >Diciembre</option>
            </select>
        </div>

        <div class="field">
            <label>Estado</label>
                <select class="ui dropdown" name="state" required>
                    <option value="scheduled"  {{$maintenance->state == 'scheduled' ? 'selected="selected"': ''}}>Calendarizada</option>
                    <option value="in_process" {{$maintenance->state == 'in_process' ? 'selected="selected"': ''}}>En Proceso</option>
                    <option value="finished" {{$maintenance->state == 'finished' ? 'selected="selected"': ''}}>Finalizada</option>
                </select>
        </div>

    </div>


    <div class="actions">
        <button class="ui right floated small green labeled cancel icon button" type="submit">
            <i class="calendar icon"></i> Actualizar
        </button>
        <a class="ui right floated small cancel blue button" href="/maintenances">Volver</a><br>
    </div>
</form>

</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
