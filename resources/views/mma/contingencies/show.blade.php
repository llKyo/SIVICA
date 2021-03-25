@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <style media="screen">
        .show_list_doc li{
                margin-top: 5px;
        }
    </style>
    <h4 class="ui horizontal dividing header"><i class="file text icon"></i> Contingencia</h4>
    <ul class="show_list_doc">

        <li> <span class="ui label red">Fecha de la Anomalía</span> : {{ $contingency->anomaly_date }} </li>
        <li> <span class="ui label blue">Fecha de visita</span> : {{ $contingency->visit_date }} </li>
        <li> <span class="ui label blue">Seguimiento</span> : {{ $contingency->tracing }} </li>
        <li> <span class="ui label blue">Parametro</span> : {{ $contingency->parameter }}</li>
        <li> <span class="ui label blue">N/S</span> : {{ $contingency->ns }}</li>
        <li> <span class="ui label blue">Causa de corte (Energía/Comunicación)</span> : {{ $contingency->causes_power_outage }}</li>
        <li> <span class="ui label blue">Causa de falla</span> : {{ $contingency->cause_failure }}</li>
        <li> <span class="ui label blue">Otra Causa</span> : {{ $contingency->another_cause }}</li>
        <li> <span class="ui label blue">Soluciona en visita</span> : {{ $contingency->solve_on_visit }}</li>
        <li> <span class="ui label blue">Gestionar otra acción luego de la visita</span> : {{ $contingency->manage_action }}</li>    
    </ul>
    <br>
    <div class="actions">
        <form action="/contingencies/{{ $contingency->id}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete">
            <button class="ui right floated small red button" type="submit">
                Eliminar
            </button>
        </form>
        <a class="ui right floated small green button" href="/contingencies/{{ $contingency->id }}/edit">Editar</a>
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
    </div>
</div>
@endsection
