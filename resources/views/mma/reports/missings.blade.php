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

<h4 class="ui horizontal dividing header"><i class="calendar icon"></i>Informe de Correlativos Faltantes por Estacion</h4>
<small style="display:none" class="header_export">Informe de Correlativos Faltantes
     Estación :: {{ $station == 'all'? 'Todas' : $station}} </small>
<div class="ui blue label">
  <i class="marker icon"></i>
  Estacion :
  <span class="detail">{{ $station == 'all'? 'Todas' : $station }}</span>
</div>
<br>
<br>
<div class="ui column">
    <table class="ui celled table sortable datatable_button">
        <thead>
            <tr>
                <th>Estación</th>
                <th>Correlativo Faltante</th>

            </tr>
        </thead>
        <tbody>    
            @foreach ($correlatives as $c)
                <tr>
                <td>{{$c->name}}</td>
                <td>{{$c->code}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
