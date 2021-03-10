@extends('layouts.app')
@section('content')

<div class="sixteen wide column">

    <h4 class="ui horizontal dividing  header"><i class="configure icon"></i>Diagnosticos y Reparaciones Equipos</h4>
    <table class="ui celled table sortable datatable">
        <thead>
            <tr>
                <th>F. Crea</th>
                <th>Tipo</th>
                <th>F. de Información</th>
                <th>Nombre Equipo</th>
                <th>Tipo Equipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>Descripcion</th>
                <th>Doc(*) / Verifica</th>

                @if(Auth::user()->rol =='admin')<th>Acciones</th>@endif

            </tr>
        </thead>
        <tbody>
            @forelse($diag_repairs as $diag_repair)
            <tr>
                <td>{{ $diag_repair->created_at }}</td>
                <td>{{ $diag_repair->option == 'repair'?'Reparacion':'Diagnostico' }}</td>
                <td>{{ $diag_repair->date }}</td>
                <td>{{ $diag_repair->element->name->name }}</td>
                <td>{{ $diag_repair->element->type->name }}</td>
                <td>{{ $diag_repair->element->brand }}</td>
                <td>{{ $diag_repair->element->model }}</td>
                <td>{{ $diag_repair->element->sn }}</td>
                <td>{{ $diag_repair->check_observation }}</td>
                <td>
                    @if($diag_repair->path != null)
                    Documento
                    <a href="{{ url('/docs/diagnostic_repair/'.$diag_repair->path)}}">
                            <i class="large download icon"></i>
                    </a>
                        @else
                            Sin Informe.
                        @endif
                </td>
                @if(Auth::user()->rol =='admin')
                <td>
                    <a class="circular ui icon defaut button mini info-modal-link" href="/element_diag_rapair/{{$diag_repair->id}}/edit"  title="Editar" style="float:left;">
                        <i class="icon blue edit"></i>
                    </a>

                    <form id="del_" action="/element_diag_rapair/{{ $diag_repair->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el diagnostico !?,')){return false;}" >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
                                <i class="icon red remove"></i>
                        </button>
                    </form>
                </td>
                @endif
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
