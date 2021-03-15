@extends('layouts.app')
@section('content')

<style media="screen">
.dataTables_filter{
    float: right;
margin-bottom: 5px;
}
.dt-buttons{
    max-width: 300px;
    float: left;
}
.dt-button{
    margin-right: 5px;
background-color: black;
padding: 5px;
border-radius: 13px;
color: white;
}
</style>
<div class="sixteen wide column">

<h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Informe Contingencias por Estacion / Año / Periodo / Parámetro / Equipo</h4>
{{-- <small style="display:none" class="header_export">Mantenciones  Estacion :: {{ $station }} | Año :: {{ $year == 'all' ? 'Todos' : $year }} | Mes ::{{ $month == 'all' ? 'Todos' : $month}} </small> --}}
<div class="ui blue label">
  <i class="marker icon"></i>
  Estacion :
  <span class="detail">{{ $station }}</span>
</div>

<div class="ui red label">
  <i class="calendar icon"></i>
  Año :
  <span class="detail">{{ $year == 'all' ? 'Todos' : $year }}</span>
</div>

<div class="ui red label">
  <i class="calendar icon"></i>
  Mes :
  <span class="detail">{{ $month == 'all' ? 'Todos' : $month}}</span>
</div>
<br>
<br>
<div class="ui column">
    <table class="ui celled table sortable datatable_button">
        <thead>
            <tr>
                <th><i class="calendar icon"></i> Año </th>
                <th><i class="calendar icon"></i> Mes </th>
                <th>Estacion/Equipo</th>

                <th>Actividad</th>
                <th>Estado</th>
                <th>Validacion</th>
                <th><i class="icon comment"></i> MMA</th>
                <th><i class="icon comment"></i> Empresa</th>

            </tr>
        </thead>
        <tbody>
                {{-- @forelse($maintenances as $maintenance)
                <tr>
                <td>{{ $maintenance->year_mma}}</td>
                <td>{{ $maintenance->month_mma}}</td>
                <td>{{ $maintenance->station->name}} <br> {{ $maintenance->element!=null ? $maintenance->element->name : '-'}}</td>

                <td>{{ $maintenance->activity->name}}</td>
                <td>
                @if($maintenance->state == 'scheduled')
                    Calendarizada
                @endif
                @if($maintenance->state == 'in_process')
                    Calendarizada
                @endif
                @if($maintenance->state == 'finished')
                    Calendarizada
                @endif
                </td>
                <td><small>
                    {{ $maintenance->execution_date  }}

                    @forelse($maintenance->documents as $document)
                            <?php $path_array = explode("/", $document->path);?>
                            {{ array_pop($path_array) }} <br>
                            <a href="{{ url('/docs/reports/'.$document->path)}}">
                                
                                <i class="large download icon"></i>
                            </a>
                    @empty
                     -
                    @endforelse
                    </small>
                </td>
                <td>{{ $maintenance->mma_comment }}</td>
                <td>{{ $maintenance->company_comment}}</td>
                </tr>
                @empty


                @endforelse --}}
        </tbody>
    </table>
</div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
