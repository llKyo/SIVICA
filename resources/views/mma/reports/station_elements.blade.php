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

<h4 class="ui horizontal dividing header"><i class="flag icon"></i>Informe Elementos por Estacion / Tipo</h4>

<small style="display:none" class="header_export">Equipo >>  Estacion :: {{ $station }} | Nombre Equipo  :: {{ $name == 'all' ? 'Todos' : $name }} </small>

<div class="ui blue label">
  <i class="marker icon"></i>
  Estacion :
  <span class="detail">{{ $station }}</span>
</div>

<div class="ui  label">
  <i class="tags icon"></i>
 Equipo :
  <span class="detail">{{ $name == 'all' ? 'Todos' : $name }}</span>
</div>

<br>
<br>
<div class="ui column">
    <table class="ui celled table sortable datatable_button">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Propietario</th>
                <th>Descripcion</th>
                <th>Estacion Asoc.</th>
            </tr>
        </thead>
        <tbody>
            @forelse($elements as $element)
            <tr>
                <td>{{ $element->name->name }}</td>
                <td>{{ $element->brand }}</td>
                <td>{{ $element->model }}</td>
                <td>{{ $element->sn }}</td>
                <td>{{ $element->type->name }}</td>
                <td>{{ $element->state == 'enable' ? 'Operativo' : 'No Operativo' }}</td>
                <td>{{ $element->owner }}</td>
                <td>{{ $element->description }}</td>
                <td>{{ $element->station == null? 'Sin estacion' : $element->station->name}}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
