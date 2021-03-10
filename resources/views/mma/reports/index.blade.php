@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
<h2>Informes & Busquedas</h2>
<h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Mantenciones por Estacion / Mes / Año</h4>

<form class="ui form" action="/reports/maintenances" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="three  fields">
        <div class="field">
            <label>Estacion</label>
            <select class="ui search dropdown" name="station">
                    <option value="all">Todas</option>
                @forelse($stations as $station)
                    <option value="{{$station->id}}">{{$station->name}}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="field">
            <label>Año</label>
            <select class="ui search dropdown" name="year">
                    <option value="all">Todos</option>
                @forelse($years as $year)
                    <option value="{{$year->date}}">{{$year->date}}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="field">
            <label>Mes</label>
            <select class="ui search dropdown" name="month">
                <option value="all">Todos</option>
                <option value="Enero">Enero</option>
                <option value="Febrero">Febrero</option>
                <option value="Marzo">Marzo</option>
                <option value="Abril">Abril</option>
                <option value="Mayo">Mayo</option>
                <option value="Junio">Junio</option>
                <option value="Julio">Julio</option>
                <option value="Agosto">Agosto</option>
                <option value="Septiembre">Septiembre</option>
                <option value="Octubre">Octubre</option>
                <option value="Noviembre">Noviembre</option>
                <option value="Diciembre">Diciembre</option>

            </select>
        </div>
    </div>

    <button class="ui right floated small blue labeled icon button" type="submit" data-content="Buscar">
        <i class="search icon"></i> Buscar
    </button>
</form>
<br>
<h4 class="ui horizontal dividing header"><i class="flag icon"></i>Equipos / por Estacion </h4>

<form class="ui form" action="/reports/elements" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="two  fields">
        <div class="field">
            <label>Estacion</label>
            <select class="ui search dropdown" name="station">
                    <option value="all">Todas</option>
                @forelse($stations as $station)
                    <option value="{{$station->id}}">{{$station->name}}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="field">
            <label>Equipo</label>
            <select class="ui search dropdown" name="name" required>
                <option value="all" >Todos</option>
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

    </div>

    <button class="ui right floated small blue labeled icon button" type="submit" data-content="Buscar">
        <i class="search icon"></i> Buscar
    </button>
</form>
<br>

<!--
<h4 class="ui horizontal dividing header"><i class="exchange icon"></i>Equipos Retirados </h4>
<form class="ui form" action="/reports/elements_nodiag" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="column">
        <div class="field">
            <label>Estacion</label>
            <select class="ui fluid search dropdown" name="station" required>
                @forelse($stations as $station)
                    <option value="{{$station->id}}">{{$station->name}}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <br>

    <button class="ui right floated small blue labeled icon button" type="submit" data-content="Buscar">
        <i class="search icon"></i> Buscar
    </button>
</form>-->

</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
