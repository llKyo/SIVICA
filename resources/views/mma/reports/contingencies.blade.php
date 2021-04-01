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

<h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Informe Contingencias por Estacion / Fecha / Parametro</h4>
<small style="display:none" class="header_export">Informe de contingencias :: {{ $station == 'all'? 'Todas' : $station}} 
    | {{$datefilter==null? ($year == 'all' ? 'Año :: Todos' : $year) : ($datefilter == 'all' ? 'Equipos :: Todos' : 'Equipos ::'. $datefilter) }}
    | Parametro :: {{ $name == 'all'? 'Todos':  $name}} </small>
<div class="ui blue label">
  <i class="marker icon"></i>
  Estacion :
  <span class="detail">{{ $station == 'all'? 'Todas' : $station }}</span>
</div>

@if ($datefilter == null)
    <div class="ui red label">
        <i class="calendar icon"></i>
        Año :
        <span class="detail">{{ $year == 'all' ? 'Todos' : $year }}</span>
    </div>
@else
    <div class="ui red label">
        <i class="calendar icon"></i>
        Fecha :
        <span class="detail">{{ $datefilter == 'all' ? 'Todas' : $datefilter }}</span>
    </div>
@endif
<div class="ui blue label">
  <i class="cogs icon"></i>
  Parametros :
  <span class="detail">{{ $name == 'all'? 'Todos' : $name }}</span>
</div>
<br>
<br>
<div class="ui column">
    <table class="ui celled table sortable datatable_button">
        <thead>
            <tr>
                <th>Fecha<br> Anomalía</th>
                <th>Fecha<br> visita</th>
                <th>Seguimiento</th>
                <th>Parametro</th>
                <th>N/S</th>
                <th>Causa <br>de corte</th>
                <th>Causa <br>de fallo</th>
                <th>Otra<br> Causa</th>
                <th>Resuelve<br> en visita</th>
                <th>Gestiona<br> Accion</th>
            </tr>
        </thead>
        <tbody>    
            @foreach ($contingencies as $c)
                <tr>
                <td>{{$c->anomaly_date}}</td>
                <td>{{$c->visit_date}}</td>
                <td>{{$c->tracking}}</td>
                <td>{{$c->parameter}}</td>
                <td>{{$c->ns}}</td>
                <td>{{$c->causes_power_outage}}</td>
                <td>{{$c->cause_failure}}</td>
                <td>{{$c->another_cause}}</td>
                <td>{{$c->solve_on_visit}}</td>
                <td>{{$c->manage_action}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
