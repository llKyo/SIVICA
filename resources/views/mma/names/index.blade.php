@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h1>Nombre Equipos</h1>
    <h4 class="ui horizontal dividing header"><i class="settings icon"></i>Crear Nuevo Nombre de Equipo</h4>
    <form class="ui form" action="/names" method="post">
        {{ csrf_field() }}
            <div class="field">
                <label>Nombre</label>
                    <input type="text" name="name" placeholder="Ingrese Nombre de Equipo" required>
            </div>
        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo Nombre Equipo">
            <i class="plus icon"></i> Crear Nuevo Nombre Equipo
        </button>


    </form>
    <br>
    <br>

    <h4 class="ui horizontal dividing  header"><i class="settings icon"></i>Lista de Nombres Equipos</h4>
    <table class="ui celled table sortable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre Equipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
                @forelse($names as $name)
                <tr>
                <td>{{ $name->id}}</td>
                <td>{{ $name->name}}</td>
                <td>
                    <a class="circular ui mini icon defaut button info-modal-link" href="/names/{{ $name->id }}/edit"  title="Editar" style="float:left;">
                        <i class="icon blue edit"></i>
                    </a>
                    <form id="del_" action="/names/{{ $name->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el nombre de equipo !?, sus datos asociados podrian perderse')){return false;}" >
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
