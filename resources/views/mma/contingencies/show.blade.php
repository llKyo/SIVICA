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

        <li> <span class="ui label red"> FECHA de la Aomalía</span> : {{ $contingency->anomaly_date }} </li>
        <li> <span class="ui label blue">Primera visita</span> : {{ $contingency->first_visit }} </li>
        <li> <span class="ui label blue">Parametro</span> : {{ $contingency->parameter }}</li>
        <li> <span class="ui label blue">N/S</span> : {{ $contingency->ns }}</li>
        <li> <span class="ui label blue">Comunicación</span> : {{ $contingency->communication }}</li>
        <li> <span class="ui label blue">Causa del fallo</span> : {{ $contingency->cause_failure }}</li>
        <li> <span class="ui label blue">Otra Causa</span> : {{ $contingency->another_cause }}</li>
        <li> <span class="ui label blue">Soluciona en visita</span> : {{ $contingency->solve_on_visit }}</li>
        <li> <span class="ui label blue">Gestionar otra acción luego de la visita</span> : {{ $contingency->manage_action }}</li>
    </ul>
    <br>
    <div class="actions">
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
    </div>
</div>
@endsection
