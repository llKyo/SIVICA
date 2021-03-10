@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h1>Actividades</h1>
    <h4 class="ui horizontal dividing header"><i class="settings icon"></i>Crear Nueva Actividad</h4>
    <form class="ui form" action="/activities" method="post">
        {{ csrf_field() }}
        <div class="two fields">
            <div class="field">
                <label>Nombre Abreviado</label>
                <div class="ui input">
                    <input type="text" name="name"  required>
                </div>
            </div>
            <div class="field">
                <label>Color Asociado (haz clic para elegir)</label>
                <div class="ui input">
                    <input type="color" name="color" style="height: 35px;"  required>
                </div>
            </div>
        </div>
            <div class="field">
                <label>Descripcion</label>
                <div class="ui input">
                    <textarea rows="2" name="description" required></textarea>
                </div>
            </div>
        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nueva Actividad">
            <i class="setting icon"></i> Crear Actividad
        </button>
    </form>

    <h4 class="ui horizontal dividing  header"><i class="settings icon"></i>Lista de Actividades</h4>
    <table class="ui celled table sortable">
        <thead>
            <tr>
                <th>Nombre (Abreviado)</th>
                <th>Color</th>
                <th>Descripcion</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
                @forelse($activities as $activity)
                <tr>
                <td>{{ $activity->name}}</td>
                <td>
                    <span style="height:10px;width:10px;background-color:{{ $activity->color}};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </td>
                <td>{{ $activity->description}}</td>
                <td>
                    <a class="circular ui mini icon defaut button info-modal-link" href="/activities/{{ $activity->id }}/edit"  title="Editar" style="float:left;">
                        <i class="icon blue edit"></i>
                    </a>
                    <form id="del_" action="/activities/{{ $activity->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar la Actividad !?, sus datos asociados podrian perderse')){return false;}" >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
                                <i class="icon red remove"></i>
                        </button>
                    </form>
                </td>
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
