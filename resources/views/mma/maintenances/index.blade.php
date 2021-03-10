@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h3>Mantenciones</h3>
    @if(Auth::user()->rol !='observer')
    <h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Crear Mantencion</h4>
    <form class="ui form" action="/maintenances" method="post">
        {{ csrf_field() }}
        <div class="two fields">
            <div class="field">
                <label>Actividad Asociada</label>
                    <select class="ui  search dropdown" name="activity_id" required>
                        @forelse($activities as $activity)
                        <option value="{{ $activity->id}}" >{{ $activity->name}}</option>
                        @empty
                        @endforelse
                    </select>
            </div>
            <div class="field">
                <label>Estacion Asociada</label>

                    <select class="ui  search dropdown" multiple="" name="station_id[]" id="station_to_element" required>
                        <option value="" >Selecciona una o varias estaciones</option>
                        @forelse($stations as $station)
                        <option value="{{ $station->id}}" >{{ $station->name}}</option>
                        @empty
                        <span>Sin Datos Aun</span>
                        @endforelse
                    </select>

            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Año</label>
                <select class="ui  dropdown"  name="year_mma">
                    <option value="2018" >2018</option>
                    <option value="2019" >2019</option>
                    <option value="2020" >2020</option>
                    <option value="2021" >2021</option>
                    <option value="2022" >2022</option>
                    <option value="2023" >2023</option>
                    <option value="2024" >2024</option>
                    <option value="2025" >2025</option>
                    <option value="2026" >2026</option>
                    <option value="2027" >2027</option>
                </select>
            </div>

            <div class="field">
                <label>Mes</label>
                <select class="ui  dropdown" multiple="" name="month_mma[]">
                    <option value="" >Selecciona uno o varios meses</option>
                    <option value="Enero" >Enero</option>
                    <option value="Febrero" >Febrero</option>
                    <option value="Marzo" >Marzo</option>
                    <option value="Abril" >Abril</option>
                    <option value="Mayo" >Mayo</option>
                    <option value="Junio" >Junio</option>
                    <option value="Julio" >Julio</option>
                    <option value="Agosto" >Agosto</option>
                    <option value="Septiembre" >Septiembre</option>
                    <option value="Octubre" >Octubre</option>
                    <option value="Noviembre" >Noviembre</option>
                    <option value="Diciembre" >Diciembre</option>
                </select>
            </div>

        </div>
        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nueva Mantencion">
            <i class="calendar icon"></i> Crear Mantencion
        </button>
    </form>


    <br><br>

    <h4 class="ui horizontal dividing  header"><i class="calendar icon"></i>Lista Mantenciones Calendarizadas</h4>
    <form class="ui form" action="" method="post">
    <div class="four fields">
        <div class="field">
            <label>Estacion </label>
                <select class="ui  search dropdown" id="station_filter" >
                    @forelse($stations as $station)
                    <option value="{{ $station->id}}" >{{ $station->name}}</option>
                    @empty
                    <span>Sin Datos Aun</span>
                    @endforelse
                </select>

        </div>

        <div class="field">
            <label>Año</label>
            <select class="ui  dropdown"  id="year_filter">
                @forelse($years as $year)
                <option value="{{ $year->year_mma }}" >{{  $year->year_mma }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="field">
            <label>Mes</label>
            <select class="ui  dropdown"  id="month_filter">
                <option value="all" >Todos</option>
                <option value="Enero" >Enero</option>
                <option value="Febrero" >Febrero</option>
                <option value="Marzo" >Marzo</option>
                <option value="Abril" >Abril</option>
                <option value="Mayo" >Mayo</option>
                <option value="Junio" >Junio</option>
                <option value="Julio" >Julio</option>
                <option value="Agosto" >Agosto</option>
                <option value="Septiembre" >Septiembre</option>
                <option value="Octubre" >Octubre</option>
                <option value="Noviembre" >Noviembre</option>
                <option value="Diciembre" >Diciembre</option>
            </select>
        </div>
        <div class="field">
            <label>&nbsp;&nbsp;</label>
            <a class="ui fluid left floated small blue labeled icon button" href="javascript:filterDataTable()" data-content="Filtrar">
                <i class="filter icon"></i> Filtrar
            </a>
        </div>
    </div>
</form>
@endif
<h4 class="ui horizontal dividing  header"></h4>

<strong>La primera visualizacion es del año y mes en curso.</strong>
<h4 class="ui horizontal dividing  header"></h4>
    <table class="ui celled table sortable datatable" id="maintenances_table">
        <thead>
            <tr>
                <th>Estacion</th>
                <th>Actividad</th>
                <th>Año</th>
                <th>Mes</th>

                <th>Verificacion</th>
                <th><i class="icon comment"></i> MMA</th>
                <th><i class="icon comment"></i> Empresa</th>
                <th>Estado</th>
                @if(Auth::user()->rol !='observer')
                <th>-- Acciones --</th>
                @endif

            </tr>
        </thead>
        <tbody>
                @forelse($maintenances as $maintenance)
                <tr>
                <td><small>{{ $maintenance->station->name}}</small></td>
                <td><small>{{ $maintenance->activity->name}}</small></td>
                <td><small>{{ $maintenance->year_mma}}</small></td>
                <td><small>{{ $maintenance->month_mma}}</small></td>

                <td><small>
                    {{ $maintenance->execution_date  }} <hr>

                    @forelse($maintenance->documents as $document)

                            @if($document->version != null)
                            <small>{{ $document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version }}</small>
                            @else
                            <small>{{ $document->station->name.' '.$document->code.' '.$document->label}}</small>
                            @endif
                            <a href="{{ url('/docs/reports/'.$document->path)}}">
                                <i class="large download icon"></i>
                            </a><br>
                    @empty
                    -
                    @endforelse
                    </small>
                </td>

                <td><small>{{ $maintenance->mma_comment }}</small></td>
                <td><small>{{ $maintenance->company_comment}}</small></td>
                <td>
                    <small>
                @if($maintenance->state == 'scheduled')
                    Calendarizada
                @endif
                @if($maintenance->state == 'in_process')
                    En Proceso
                @endif
                @if($maintenance->state == 'finished')
                    Finalizada
                @endif
                    </small>
                </td>
                @if(Auth::user()->rol !='observer')
                <td>

                    <a class="circular ui mini icon defaut button" href="/maintenances/{{ $maintenance->id }}/edit"  title="Editar" style="float:left;">
                        <i class="icon blue edit"></i>
                    </a>
                    <form id="del_" action="/maintenances/{{ $maintenance->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar la Mantencion !?, sus datos asociados podrian perderse')){return false;}" >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
                                <i class="icon red remove"></i>
                        </button>
                    </form>
                    <a class="circular ui mini icon defaut button pop" href="/maintenances/{{ $maintenance->id }}/edit_comments"  title="Comentar" style="float:left;" data-content="Comentar!">
                        <i class="icon blue comment"></i>
                    </a>

                </td>
                @endif

                </tr>
                @empty
                <span>sin registros aun</span>

                @endforelse
        </tbody>
    </table>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

<script type="text/javascript">
$(document).ready(function() {
var events = 'events.json';

});

function filterDataTable()
{
    $('#maintenances_table').DataTable().destroy();
    $.getJSON('/api/maintenances/station/'+$('#station_filter :selected').val()+'/year/'+$('#year_filter :selected').val()+'/month/'+$('#month_filter :selected').val(), function(data){
        //$('#table_files').empty();
        $('#maintenances_table').DataTable({
           "aaData": data,
           "aoColumns": [
                {"mDataProp":"station"},
                {"mDataProp":"activity"},
                {"mDataProp":"year"},
               {"mDataProp":"month"},
                {"mDataProp":"validation"},
                {"mDataProp":"mma_comment"},
                {"mDataProp":"company_comment"},
                {"mDataProp":"status"},
                {"mDataProp":"actions"}
           ],
           "paging":   true,
           "ordering": true,
           "info":     true,
           fixedHeader: true,
           destroy: true,
       });
   });
}


</script>
@endsection
