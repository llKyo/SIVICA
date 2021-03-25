@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <style media="screen">
        .show_list_doc li{
                margin-top: 5px;
        }
    </style>
    <h4 class="ui horizontal dividing header"><i class="file text icon"></i> Modificar contingencia</h4>
    <form class="ui form" action="/contingencies/{{ $contingency->id }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put">
    {{-- <input type="hidden" name="id" value="{{ $contingency->id }}"> --}}

    

    <div class="three fields">
        <div class="field">
            <label>Fecha de la anomalía</label>
                <input class="ui input" type="date" name="anomaly_date" placeholder="..." value="{{ $contingency->anomaly_date }}">
        </div>

        <div class="field">
            <label>Fecha de la visita</label>
                <input class="ui input" type="date" name="visit_date" placeholder="..." value="{{ $contingency->visit_date }}">
        </div>
        
    </div>
    <div class="three fields">
        <div class="field">
            <label>Visita de seguimiento a contingencia o primera visita</label>
                <input class="ui input" type="text" name="tracing" placeholder="..." value="{{ $contingency->tracing }}">
        </div>

        <div class="field">
            <label>Parametro</label>
            <select class="ui search dropdown" name="parameter" required>
                <option value="OTRO" {{$contingency->parameter == 'OTRO'? 'selected' : ''}} >OTRO (Ninguno de la lista)</option>
                <option value="MP" {{$contingency->parameter == 'MP'? 'selected' : ''}}>MP</option>
                <option value="O3" {{$contingency->parameter == 'O3'? 'selected' : ''}}>O3</option>
                <option value="CO" {{$contingency->parameter == 'OTRO'? 'selected' : ''}}>CO</option>
                <option value="NO/NOx" {{$contingency->parameter == 'NO/NOx'? 'selected' : ''}}>NO/NOx</option>
                <option value="SO2" {{$contingency->parameter == 'SO2'? 'selected' : ''}}>SO2</option>
                <option value="WS" {{$contingency->parameter == 'WS'? 'selected' : ''}}>WS</option>
                <option value="WD" {{$contingency->parameter == 'WD'? 'selected' : ''}}>WD</option>
                <option value="RS" {{$contingency->parameter == 'RS'? 'selected' : ''}}>RS</option>
                <option value="THR" {{$contingency->parameter == 'THR'? 'selected' : ''}}>THR</option>
                <option value="P°" {{$contingency->parameter == 'P°'? 'selected' : ''}}>P°</option>
                <option value="PLUVIO" {{$contingency->parameter == 'PLUVIO'? 'selected' : ''}}>PLUVIO</option>
                <option value="DILUTOR" {{$contingency->parameter == 'DILUTOR'? 'selected' : ''}}>DILUTOR</option>
                <option value="GAZ" {{$contingency->parameter == 'GAZ'? 'selected' : ''}}>GAZ</option>
                <option value="LOGGER" {{$contingency->parameter == 'LOGGER'? 'selected' : ''}}>LOGGER</option>
                <option value="MODEM" {{$contingency->parameter == 'MODEM'? 'selected' : ''}}>MODEM</option>
                <option value="PC" {{$contingency->parameter == 'PC'? 'selected' : ''}}>PC</option>
                <option value="AA" {{$contingency->parameter == 'AA'? 'selected' : ''}}>AA</option>
                <option value="UPS" {{$contingency->parameter == 'UPS'? 'selected' : ''}}>UPS</option>
                <option value="BOMBA" {{$contingency->parameter == 'BOMBA'? 'selected' : ''}}>BOMBA</option>
            </select>
        </div>

        <div class="field">
            <label>Modelo/NS/Propietario</label>
                <input class="ui input" type="text" name="ns" placeholder="..." value="{{ $contingency->ns }}">
        </div>
    </div>

    <div class="three fields">
        <div class="field">
            <label>Causa corte de energía o comunicación</label>
                <textarea rows="2" name="causes_power_outage" value="">{{ $contingency->causes_power_outage }}</textarea>
        </div>

        <div class="field">
            <label>Causa falla técnica</label>
                <textarea rows="2" name="cause_failure" value="">{{ $contingency->cause_failure }}</textarea>
        </div>

        <div class="field">
            <label>Otra causa</label>
                <textarea rows="2" name="another_cause" value="">{{ $contingency->another_cause }}</textarea>
        </div>
    </div>

    <div class="two fields">
        

        <div class="field">
            <label>Soluciona en visita</label>
                <select class="ui search dropdown" name="solve_on_visit">
                    <option value="si" {{$contingency->solve_on_visit == 'si'? 'selected' : ''}}>Si</option>
                    <option value="no" {{$contingency->solve_on_visit == 'no'? 'selected' : ''}}>No</option>
                
            </select>
        </div>

        <div class="field">
            <label>Gestionar otra acción luego de la visita</label>
                <input class="ui input" type="text" name="manage_action" placeholder="..." value="{{ $contingency->manage_action }}">
        </div>
        {{-- <div class="field">
            <label>Estación Asociada</label>
            <input class="ui input" type="hidden" name="station_id" value="{{ $station->id }}">
            <input class="ui input" type="text" name="station_name" disabled value="{{ $station->name }}">
        </div> --}}
    </div>
    



    <div class="actions">
        <button class="ui right floated small red labeled cancel icon button" type="submit">
            <i class="edit icon"></i> Modificar
        </button>
        <a class="ui right floated small cancel blue button" href="/documents">Volver</a><br>
    </div>
</form>
    {{-- <div class="actions">
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
    </div> --}}
</div>
@endsection
