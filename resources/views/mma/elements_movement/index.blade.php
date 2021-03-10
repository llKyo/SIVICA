@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <h4 class="ui horizontal dividing  header"><i class="exchange icon"></i>Movimiento de Equipos</h4>



    <table class="ui celled table sortable datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Movimiento</th>
                <th>Movimiento </th>
                <th> Destino</th>
                <th> Origen</th>
                <th>Equipo</th>
                <th>Equipo-Tipo</th>
                <th> Marca - Modelo - N. Serie </th>
                <th>Estado</th>
                <th>Observacion</th>
            </tr>
        </thead>
        <tbody>

            @forelse($incidents as $incident)
            <tr>
                <td>{{ $incident->id }}</td>
                <td>{{ $incident->date }}</td>
                <td>
                    @if($incident->movement == 'remove')
                        Retira

                    @elseif($incident->movement == 'install')
                        Instala

                    @elseif($incident->movement == 'station_to_estation')
                        Cambio de Estacion
                    @endif
                </td>
                <td>{{ $incident->place }}</td>
                <td>{{ $incident->previus_place }}</td>
                <td>{{ $incident->element->name->name }}</td>
                <td>{{ $incident->element->type->name }}</td>
                <td><small>{{ $incident->element->brand }}</small> <br> <small>{{$incident->element->model}}</small> <br> <small>{{$incident->element->sn }}</small></td>
                <td>{{ $incident->state == 'enable' ? 'Operativo' : 'No Operativo' }}</td>
                <td>{{ $incident->observation }}</td>
            </tr>
            @empty
            <span>sin registros aun</span>
            @endforelse
        </tbody>
    </table>


    {{-- Modal Edit--}}
    <div class="ui small info modal edit_modal">
        <div class="content"></div>
    </div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
