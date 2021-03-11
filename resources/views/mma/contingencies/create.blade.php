@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <style media="screen">
        .show_list_doc li{
                margin-top: 5px;
        }
    </style>
    <h4 class="ui horizontal dividing header"><i class="file text icon"></i> Crear contingencia</h4>
    <form class="ui form" action="">
    {{ csrf_field() }}
    <input type="hidden" name="document_id" value="{{ $document_id }}">

    

    <div class="three fields">
        <div class="field">
            <label>Fecha de la anomalía</label>
                <input class="ui input" type="text" placeholder="...">
        </div>
        
        <div class="field">
            <label>Visita de seguimiento a contingencia o primera visita</label>
                <input class="ui input" type="text" placeholder="...">
        </div>

        <div class="field">
            <label>Parámetro</label>
                <input class="ui input" type="text" placeholder="...">
        </div>
    </div>

    <div class="three fields">
        <div class="field">
            <label>Modelo/NS/Propietario</label>
                <input class="ui input" type="text" placeholder="...">
        </div>

        <div class="field">
            <label>Causa corte de energía o comunicación</label>
                <input class="ui input" type="text" placeholder="...">
        </div>

        <div class="field">
            <label>Causa falla técnica en equipo de parámetro</label>
                <input class="ui input" type="text" placeholder="...">
        </div>
    </div>

    <div class="three fields">
        <div class="field">
            <label>Otra causa</label>
                <input class="ui input" type="text" placeholder="...">
        </div>

        <div class="field">
            <label>Soluciona en visita</label>
                <input class="ui input" type="text" placeholder="...">
        </div>

        <div class="field">
            <label>Gestionar otra acción luego de la visita</label>
                <input class="ui input" type="text" placeholder="...">
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
