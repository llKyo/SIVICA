@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h1>Logs / Acciones de Sistema</h1>

    <h4 class="ui horizontal dividing  header"><i class="file icon"></i>Lista de Logs</h4>
    <table class="ui celled table datatable_log">
        <thead>
            <tr>
                <th>Fecha / Hora</th>
                <th>Usuario Realiza Accion</th>
                <th>Tema / Item </th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
                @forelse($logs->reverse() as $log)
                <tr>
                <td>{{ $log->created_at}}</td>
                <td>{{ $log->user_name}} (id:{{ $log->user_id}})</td>
                <td>{{ $log->item}}</td>
                <td>{{ $log->action}}</td>
                </tr>
                @empty
                <span>sin registros aun</span>
                @endforelse
        </tbody>
    </table>


</div>{{-- div From App--}}
</div>{{-- div From App--}}
<script type="text/javascript">
</script>
@endsection
