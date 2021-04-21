@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <style media="screen">
        .show_list_doc li{
                margin-top: 5px;
        }
    </style>
    <h4 class="ui horizontal dividing header"><i class="file text icon"></i> Crear contingencia</h4>
    <form class="ui form" action="/contingencies" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="document_id" value="{{ $document_id }}">
    <input type="hidden" name="station_id" value="{{ $station_id }}">

    <div class="three fields">
        <div class="field">
            <label>Fecha de la anomalía</label>
                <input class="ui input" type="date" name="anomaly_date" placeholder="...">
        </div>

        <div class="field">
            <label>Fecha de la visita</label>
                <input class="ui input" type="date" name="visit_date" placeholder="...">
        </div>
        
    </div>
    <div class="three fields">
        <div class="field">
            <label>Visita de seguimiento a contingencia o primera visita</label>
                <input class="ui input" type="text" name="tracking" placeholder="...">
        </div>

        <div class="field">
            <label>Parametro</label>
            <select class="ui search dropdown" name="parameter" required>
                <option value="OTRO" >OTRO (Ninguno de la lista)</option>
                <option value="MP" >MP</option>
                <option value="O3" >O3</option>
                <option value="CO" >CO</option>
                <option value="NO/NOx" >NO/NOx</option>
                <option value="SO2" >SO2</option>
                <option value="WS" >WS</option>
                <option value="WD" >WD</option>
                <option value="RS" >RS</option>
                <option value="THR" >THR</option>
                <option value="P°" >P°</option>
                <option value="PLUVIO" >PLUVIO</option>
                <option value="DILUTOR" >DILUTOR</option>
                <option value="GAZ" >GAZ</option>
                <option value="LOGGER" >LOGGER</option>
                <option value="MODEM" >MODEM</option>
                <option value="PC" >PC</option>
                <option value="AA" >AA</option>
                <option value="UPS" >UPS</option>
                <option value="BOMBA" >BOMBA</option>
            </select>
        </div>

        <div class="field">
            <label>Modelo/NS/Propietario</label>
                <input class="ui input" type="text" name="ns" placeholder="...">
        </div>
    </div>

    <div class="three fields">
        <div class="field">
            <label>Causa corte de energía o comunicación</label>
                <textarea rows="2" name="causes_power_outage"></textarea>
        </div>

        <div class="field">
            <label>Causa falla técnica</label>
                <textarea rows="2" name="cause_failure"></textarea>
        </div>

        <div class="field">
            <label>Otra causa</label>
                <textarea rows="2" name="another_cause"></textarea>
        </div>
    </div>

    <div class="two fields">
        

        <div class="field">
            <label>Soluciona en visita</label>
                <select class="ui search dropdown" name="solve_on_visit" required>
                    <option value="si" selected="selected">Si</option>
                    <option value="no">No</option>
                
            </select>
        </div>

        <div class="field">
            <label>Gestionar otra acción luego de la visita</label>
                <input class="ui input" type="text" name="manage_action" placeholder="...">
        </div>
    </div>
    



    <div class="actions">
        <button class="ui right floated small green labeled cancel icon button" type="submit">
            <i class="add icon"></i> Crear
        </button>
        <a class="ui right floated small cancel blue button" href="/documents">Volver</a><br>
    </div>
</form>
    {{-- <div class="actions">
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
    </div> --}}
</div>
@endsection
